<?php
// $Id: xmlsitemap.pages.inc,v 1.1.2.12 2009/05/23 00:21:23 davereid Exp $

/**
 * @file
 * Page callbacks for the xmlsitemap module.
 */

/**
 * Output a sitemap page.
 */
function xmlsitemap_output($chunk = 0) {
  $file = xmlsitemap_get_chunk_file($chunk);

  if (!file_exists($file) || (isset($_GET['refresh']) && user_access('administer xmlsitemap'))) {
    if (!xmlsitemap_generate($chunk)) {
      return drupal_not_found();
    }
  }

  $last_modified = gmdate('D, d M Y H:i:s', filemtime($file)) . ' GMT';
  $etag = '"' . md5($last_modified) . '"';

  // See if the client has provided the required HTTP headers.
  $if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) : FALSE;
  $if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) : FALSE;
  if ($if_modified_since && $if_none_match && $if_none_match == $etag && $if_modified_since == $last_modified) {
    header('HTTP/1.1 304 Not Modified');
    // All 304 responses must send an etag if the 200 response for the same object contained an etag
    header('Etag: ' . $etag);
    exit;
  }

  $headers = array(
    'Content-type: text/xml; charset=utf-8',
    //'Content-length: ' . filesize($file),
    'Last-modified: ' . $last_modified,
    'Etag: ' . $etag,
    'Expires: Sun, 20 May 1984 00:00:00 GMT',
    'Cache-Control: must-revalidate',
  );

  // Transfer the file as output.
  file_transfer($file, $headers);
}

/**
 * Output an XML transformation file for the sitemap XML.
 */
function xmlsitemap_output_xsl() {
  drupal_set_header('Content-type: application/xml; charset=utf-8');
  $module_path = drupal_get_path('module', 'xmlsitemap');
  $xsl_css = url($module_path . '/xmlsitemap-xml.css');
  $xsl_js = url($module_path . '/xmlsitemap-xml.js');

  $contents = file_get_contents($module_path . '/xmlsitemap.xsl');
  $contents = str_replace(array('[xsl-css]', '[xsl-js]'), array($xsl_css, $xsl_js), $contents);
  echo $contents;
}
