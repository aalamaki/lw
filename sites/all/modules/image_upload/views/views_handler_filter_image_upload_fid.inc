<?php
// $Id: views_handler_filter_image_upload_fid.inc,v 1.1.2.3 2008/10/17 19:30:41 bojanz Exp $
/**
 * Filter by whether or not a node has attached images from the image_upload module
 */

class views_handler_filter_image_upload_fid extends views_handler_filter_boolean_operator {
  function construct() {
    parent::construct();
    $this->value_value = t('Has attached images');
  }

  function query() {
    $this->ensure_my_table();
    $this->query->add_where($this->options['group'], "(SELECT COUNT(*) FROM {image_upload} u WHERE u.vid = $this->table_alias.$this->real_field) " . (empty($this->value) ? '=' : '<>') . " 0");
  }
}
