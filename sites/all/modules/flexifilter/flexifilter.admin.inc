<?php
// $Id: flexifilter.admin.inc,v 1.14.2.2.4.4 2008/06/19 05:57:10 dmitrig01 Exp $

/**
 * Generates the form for the admin overview page
 */
function flexifilter_filter_list_form() {
  drupal_set_title("Flexifilters overview");
  $path = drupal_get_path('module', 'flexifilter') .'/flexifilter.css';
  drupal_add_css($path, 'module', 'all', FALSE);

  $form = array();
  $form['enabled_header'] = array(
    '#value' => '<h3>'. t('Enabled Flexifilters') .'</h3>',
    '#suffix' => t('If a flexifilter is enabled, then it can be used within input formats, however there can only be 128 enabled at any one time.') .'<br/>',
  );
  $form['enabled'] = flexifilter_filter_list_form_table(TRUE);

  $form['disabled_header'] = array(
    '#value' => '<h3>'. t('Disabled Flexifilters') .'</h3>',
    '#suffix' => t('If a flexifilter is disabled, then it cannot be used within input formats, although it can be used within other flexifilters.') .'<br/>',
  );
  $form['disabled'] = flexifilter_filter_list_form_table(FALSE);

  return $form;
}

/**
 * Helper function for flexifilter_filter_list_form. Returns the table for the overview page.
 *
 * @param $enabled
 *   Is TRUE if we're theming the currently enabled filters.
 */
function flexifilter_filter_list_form_table($enabled) {
  $show_disable_link = $enabled;
  $show_enable_link  = !$enabled;
  $header            = array(t('Label'), t('Description'), t('Edit'), t('Delete'), t('Preview'), t($enabled ? 'Disable' : 'Enable'));
  $rows              = array();
  $filters           = flexifilter_flexifilter_list();
  foreach ($filters as $id => $filter) {
    if ($filter['enabled'] == $enabled) {
      $row   = array(check_plain($filter['label']), check_plain($filter['description']));
      $row[] = l(t('Edit'), 'admin/build/flexifilters/'. $id .'/edit', array(), drupal_get_destination());
      $row[] = l(t('Delete'), 'admin/build/flexifilters/'. $id .'/delete', array(), drupal_get_destination());
      $row[] = l(t('Preview'), 'admin/build/flexifilters/'. $id .'/preview', array(), drupal_get_destination());  
      if ($show_disable_link) {
        $row[] = l(t('Disable'), 'admin/build/flexifilters/'. $id .'/disable', array(), drupal_get_destination());
      }
      else if ($show_enable_link) {
        $row[] = l(t('Enable'), 'admin/build/flexifilters/'. $id .'/enable', array(), drupal_get_destination());
      }
      else {
        $row[] = '';
      }
      $rows[] = $row;
    }
  }
  if (count($rows)) {
    return array('#value' => theme('table', $header, $rows, array('class' => 'flexifilters-list')));
  }
  else {
    $message = ($enabled? t('There are currently no enabled flexifilters.') : t('There are currently no disabled flexifilters.'));
    return array('#value' => '<br /><strong>'. $message .'</strong>');
  }
}

/**
 * The add/edit form for flexifilters.
 */
function flexifilter_filter_edit_form($form_state, $flexifilter = 'new') {
  $form['under_construction'] = array(
    '#value' => '<strong>This form is currently under construction.</strong>',
  );
  
  return $form;
}

function flexifilter_filter_delete_form($form_state, $flexifilter) {
  $form = array();
  $form['flexifilter'] = array('#type' => 'value', '#value' => $flexifilter);
  return confirm_form($form, t('Are you sure you want to delete the flexifilter "%flexifilter"?', array('%flexifilter' => $flexifilter['label'])), 'admin/build/flexifilters', t('This action cannot be undone.'), t('Delete'), t('Cancel'));
}

function flexifilter_filter_delete_form_submit($form, &$form_state) {
  $flexifilter = $form_state['values']['flexifilter'];
  if ($flexifilter['enabled']) {
    _flexifilter_remove_from_filters($flexifilter['delta']);
  }
  db_query('DELETE FROM {flexifilters_parts} WHERE fid = %d', $flexifilter['fid']);
  db_query('DELETE FROM {flexifilters} WHERE fid = %d', $flexifilter['fid']);
  drupal_set_message(t('Flexifilter deleted.'));
  $form_state['redirect'] = 'admin/build/flexifilters';
}

function flexifilter_filter_disable_form($form_state, $flexifilter) {
  $form = array();
  $form['flexifilter'] = array('#type' => 'value', '#value' => $flexifilter);
  return confirm_form($form, t('Are you sure you want to disable the flexifilter "%flexifilter"?', array('%flexifilter' => $flexifilter['label'])), 'admin/build/flexifilters', t('If you disable the flexifilter, then it cannot be used in any Input Formats.'), t('Disable'), t('Cancel'));
}

function flexifilter_filter_disable_form_submit($form, &$form_state) {
  $flexifilter = $form_state['values']['flexifilter'];
  if ($flexifilter['enabled']) {
    _flexifilter_remove_from_filters($flexifilter['delta']);
    db_query('UPDATE {flexifilters} SET enabled = 0 WHERE fid = %d', $flexifilter['fid']);
    drupal_set_message(t('Flexifilter disabled.'));
  }
  $form_state['redirect'] = 'admin/build/flexifilters';
}

function flexifilter_filter_enable_form($form_state, $flexifilter) {
  $form = array();
  $form['flexifilter'] = array('#type' => 'value', '#value' => $flexifilter);
  return confirm_form($form, t('Are you sure you want to enable the flexifilter "%flexifilter"?', array('%flexifilter' => $flexifilter['label'])), 'admin/build/flexifilters', t(''), t('Enable'), t('Cancel'));
}

function flexifilter_filter_enable_form_submit($form, &$form_state) {
  $flexifilter = $form_state['values']['flexifilter'];
  if (!$flexifilter['enabled'] && flexifilter_flexifilter_count() < FLEXIFILTER_MAX_FILTERS) {
    db_query('UPDATE {flexifilters} SET enabled = 1, delta = %d WHERE fid = %d', flexifilter_get_unused_delta(), $flexifilter['fid']);
    drupal_set_message(t('Flexifilter enabled.'));
  }
  elseif (!$flexifilter['enabled']) {
    drupal_set_message(t('The flexifilter could not be enabled because you have too many flexifilters currently enabled.'), 'error');
  }
  $form_state['redirect'] = 'admin/build/flexifilters';
}

function flexifilter_filter_export_form($form_state, $flexifilter) {
  $form = array();
  $flexifilter['fid'] = 'new';
  $form['serialized'] = array(
    '#type' => 'textarea',
    '#attributes' => array('readonly' => 'readonly'),
    '#cols' => '100',
    '#title' => t('Serialized flexifilter (for manual imports)'),
    '#default_value' => serialize($flexifilter),
  );
  $form['flexifilter'] = array(
    '#type' => 'textarea',
    '#attributes' => array('readonly' => 'readonly'),
    '#cols' => '100',
    '#title' => t('Exported flexifilter (for hook_flexifilters implementations)'),
    '#default_value' => var_export($flexifilter, TRUE),
  );
  return $form;
}

function flexifilter_filter_input_form($form_state) {
  $form = array();
  $form['flexifilter'] = array(
    '#type' => 'textarea',
    '#title' => t('Flexifilter to import'),
    '#description' => t('Enter the serialized flexifilter as from a flexifilter export here.'),
    '#default_value' => '',
    '#required' => TRUE,
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Import'),
  );
  return $form;
}

function flexifilter_filter_input_form_submit($form, &$form_state) { 
  $fid = unserialize($form_state['values']['flexifilter']);
  if ($fid) {
    drupal_goto('admin/build/flexifilters/'. flexifilter_flexifilter_save($form_state['values']['flexifilter']) .'/edit');
  }
  else {
    drupal_set_message(t('It appears that the serialized flexifilter you entered was improperly formed. Please check the source.'), 'error');
  }
}

function flexifilter_filter_default_form($form_state) {
  $flexifilters = module_invoke_all('flexifilters');
  $names = array();
  foreach ($flexifilters as $key => $flexifilter) {
    $names[$key] = $flexifilter['label'];
  }
  $form['selections'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Default flexifilters to load'),
    '#multiple' => TRUE,
    '#options' => $names,
    '#required' => TRUE,
    '#default_value' => array(),
  );
  $form['flexifilters'] = array(
    '#type' => 'value',
    '#value' => $flexifilters,
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Load'),
  );
  return $form;
}

function flexifilter_filter_default_form_submit($form, &$form_state) {
  $flexifilters = $form_state['values']['flexifilters'];
  $selections = $form_state['values']['selections'];
  $to_be_saved = array();
  foreach ($selections as $selection) {
    if (isset($flexifilters[$selection])) {
      $to_be_saved[] = $flexifilters[$selection];
    }
  }
  flexifilter_flexifilter_install('flexifilter', $to_be_saved);
  $form_state['redirect'] = 'admin/build/flexifilters';
}