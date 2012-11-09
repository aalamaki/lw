<?php
// $Id: views_handler_field_image_upload_fid.inc,v 1.1.2.3 2008/10/17 19:30:41 bojanz Exp $
/**
 * Field handler to provide a list of roles.
 */

class views_handler_field_image_upload_fid extends views_handler_field_prerender_list {
  function construct() {
    parent::construct();
  }

  function get_terms() {
    $terms = array();

    $result = db_query("SELECT vid FROM {vocabulary} WHERE name = 'Image Upload'");
    while ($vocabulary = db_fetch_object($result)) {
      $vid = $vocabulary->vid;
    }

    $result = db_query("SELECT name, tid FROM {term_data} WHERE vid = %d", $vid);

    while ($term = db_fetch_object($result)) {
      $terms[$term->tid] = $term->name;
    }

    return $terms;
  }

  function query() {
    parent::query();

    $this->ensure_my_table();

    $this->query->add_groupby("node.vid");

    if(count($this->options['link_to_term']) > 0) {
      $tids = array();
      foreach($this->options['link_to_term'] as $tid) {
        $tids[] = $tid;
      }

      $tids = implode(",", $tids);

      $this->query->add_where($this->options['group'], "image_upload.tid IN($tids)");
    }
  }

  function option_definition() {
    $options = parent::option_definition();
    $options['link_to_file'] = array('default' => FALSE);
    return $options;
  }

  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    $form['link_to_file'] = array(
      '#title' => t('Link this field to the full image.'),
      '#type' => 'checkbox',
      '#default_value' => !empty($this->options['link_to_file']),
    );

    $form['only_one'] = array(
      '#type' => 'checkbox',
      '#title' => t('Show only the first uploaded image.'),
      '#default_value' => $this->options['only_one'],
    );

    $form['link_to_term'] = array(
      '#type' => 'select',
      '#title' => t('Only show the images from these categories:'),
      '#default_value' => $this->options['link_to_term'],
      '#options' => $this->get_terms(),
      '#multiple' => TRUE,
    );
  }

  function pre_render($values) {
    $vids = array();
    $this->items = array();

    $data = array();
    foreach ($values as $result) {
      $vids[] = $result->{$this->field_alias};
    }

    if ($vids) {
      $vids = array_unique($vids);

      $group_by = '';

      if(!empty($this->options['only_one'])) {
        $group_by = ' GROUP BY u.vid ';
      }

      $result = db_query("SELECT u.vid, u.fid, f.filepath, u.thumbpath, u.description FROM {image_upload} u LEFT JOIN {files} f ON f.fid = u.fid WHERE u.vid IN (" . implode(', ', $vids) . ") $group_by ORDER BY u.weight ASC, u.fid ASC");

      while ($file = db_fetch_object($result)) {
        $this->items[$file->vid][$file->fid] = $this->render_link($file->thumbpath, $file);
      }
    }
  }

  /**
   * Render whatever the data is as a link to the file.
   *
   * Data should be made XSS safe prior to calling this function.
   */
  function render_link($data, $values) {
    list($width, $height, $type, $image_attributes) = @getimagesize($values->thumbpath);

    $data = '<img src="' . url($data, array('absolute' => true))  .'" width="' . $width . '" height="' . $height . '" />';

    if (!empty($this->options['link_to_file'])) {
      $options = array(
        'html' => TRUE,
        'attributes' => array('rel' => 'lightbox[view][' . $values->description . ']')
      );

      return l($data, file_create_url($values->filepath), $options);
    }
    else {
      return $data;
    }
  }
}
