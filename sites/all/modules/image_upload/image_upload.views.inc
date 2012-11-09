<?php
// $Id: image_upload.views.inc,v 1.1.2.2 2008/10/17 19:30:41 bojanz Exp $

/**
 * @file
 *
 * Provide views data and handlers for image_upload tables.
 */

/**
 * @defgroup views_image_upload_module image_upload.module handlers
 *
 * @{
 */

/**
 * Implementation of hook_views_data()
 */
function image_upload_views_data() {
  $data = array();

  // ----------------------------------------------------------------------
  // image_upload table

  $data['image_upload']['table']['group']  = t('Image Upload');

  $data['image_upload']['table']['join'] = array(
    'node' => array(
      'left_field' => 'vid',
      'field' => 'vid',
    ),
    'node_revisions' => array(
      'left_field' => 'vid',
      'field' => 'vid',
    ),
    'files' => array(
      'left_field' => 'fid',
      'field' => 'fid',
    ),
  );

  $data['image_upload']['vid'] = array(
    'title' => t('Node'),
    'help' => t('The node the uploaded image is attached to'),
     'relationship' => array(
      'label' => t('image_upload'),
      'base' => 'node',
      'base field' => 'vid',
      // This allows us to not show this relationship if the base is already
      // node so users won't create circular relationships.
      'skip base' => array('node', 'node_revisions'),
    ),
  );

  $data['image_upload']['description'] = array(
    'title' => t('Description'),
    'help' => t('The description of the uploaded image.'),
    'field' => array(
      'handler' => 'views_handler_field_image_upload_description',
      'click sortable' => TRUE,
     ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  $data['image_upload']['weight'] = array(
    'title' => t('Weight'),
    'help' => t('The weight, used for sorting.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
     ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
    ),
  );

  return $data;
}

function image_upload_views_data_alter(&$data) {
  $data['node']['image_upload_fid'] = array(
    'group' => t('Image Upload'),
    'title' => t('Attached images'),
    'help' => t('All images attached to a node with image_upload.module.'),
    'real field' => 'vid',
    'field' => array(
      'handler' => 'views_handler_field_image_upload_fid',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_image_upload_fid',
      'title' => t('Has attached images'),
      'help' => t('Only display items with attached images. This can cause duplicates if there are multiple attached images.'),
    ),
    'relationship' => array(
      'title' => t('Attached images'),
      'help' => t('Add a relationship to gain access to more file data for images uploaded by image_upload.module. Note that this relationship will cause duplicate nodes if there are multiple images attached to the node.'),
      'relationship table' => 'image_upload',
      'relationship field' => 'fid',
      'base' => 'files',
      'field' => 'fid',
      'handler' => 'views_handler_relationship',
      'label' => t('Images'),
    ),
  );
}

/**
 * Implementation of hook_views_handlers() to register all of the basic handlers
 * views uses.
 */
function image_upload_views_handlers() {
  return array(
    'info' => array(
      'path' => drupal_get_path('module', 'image_upload') . '/views',
    ),
    'handlers' => array(
      'views_handler_field_image_upload_fid' => array(
        'parent' => 'views_handler_field_prerender_list',
      ),
      'views_handler_field_image_upload_description' => array(
        'parent' => 'views_handler_field_prerender_list',
      ),
      'views_handler_filter_image_upload_fid' => array(
        'parent' => 'views_handler_filter_boolean_operator',
      ),
    ),
  );
}

/**
 * @}
 */
