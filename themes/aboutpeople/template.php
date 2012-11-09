<?php
//template for aboutpeople Theme
//author: slasant - www.slasant.ru


// login line


function aboutpeople_width($left, $right) {
  $width = 570;
  if (!$left ) {
    $width = $width +200;
  }  
  
   if (!$right) {
    $width = $width +200;
  }
  return $width;
}



/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
       return '<div class="path"><p>'. implode(' / ', $breadcrumb) .'</p></div>';
  }
  }


//overrides taxonomy term page function
function aboutpeople_taxonomy_term_page($tids, $result) {
  drupal_add_css(drupal_get_path('module', 'taxonomy') .'/taxonomy.css');

  $output = '';

  // Only display the description if we have a single term, to avoid clutter and confusion.
  if (count($tids) == 1) {
    $term = taxonomy_get_term($tids[0]);
    $description = $term->description;

    // Check that a description is set.
    if (!empty($description)) {
      $output .= '<div class="terminfo"><p>';
      $output .= filter_xss_admin($description);
      $output .= '</p></div>';
    }
  }

  $output .= taxonomy_render_nodes($result);

  return $output;
}





function aboutpeople_admin_page($blocks) {
  $stripe = 0;
  $container = array();

  foreach ($blocks as $block) {
    if ($block_output = theme('admin_block', $block)) {
      if (empty($block['position'])) {
        // perform automatic striping.
        $block['position'] = ++$stripe % 2 ? 'left' : 'right';
      }
      if (!isset($container[$block['position']])) {
        $container[$block['position']] = '';
      }
      $container[$block['position']] .= $block_output;
    }
  }

  $output = '<div class="admin clear-block">';
  $output .= '<div class="compact-link"><p>'; // use <p> for hide/show anchor
  if (system_admin_compact_mode()) {
    $output .= l(t('Show descriptions'), 'admin/compact/off', array('title' => t('Expand layout to include descriptions.')));
  }
  else {
    $output .= l(t('Hide descriptions'), 'admin/compact/on', array('title' => t('Compress layout by hiding descriptions.')));
  }
  $output .= '</p></div>';

  foreach ($container as $id => $data) {
    $output .= '<div class="'. $id .' clear-block">';
    $output .= $data;
    $output .= '</div>';
  }
  $output .= '</div>';
  return $output;
}

function aboutpeople_admin_block_content($content) {
  if (!$content) {
    return '';
  }

  if (system_admin_compact_mode()) {
    $output = '<dl class="menu">';
    foreach ($content as $item) {
      $output .= '<dt>'. l($item['title'], $item['href'], $item['localized_options']) .'</dt>'; // use definition list per compact mode
    }
    $output .= '</dl>';
  }
  else {
    $output = '<dl class="admin-list">';
    foreach ($content as $item) {
      $output .= '<dt>'. l($item['title'], $item['href'], $item['localized_options']) .'</dt>';
      $output .= '<dd>'. $item['description'] .'</dd>';
    }
    $output .= '</dl>';
  }
  return $output;
}

function aboutpeople_system_admin_by_module($menu_items) { // admin by module page
  $stripe = 0;
  $output = '';
  $container = array('left' => '', 'right' => '');
  $flip = array('left' => 'right', 'right' => 'left');
  $position = 'left';

  // Iterate over all modules
  foreach ($menu_items as $module => $block) {
    list($description, $items) = $block;

    // Output links
    if (count($items)) {
      $block = array();
      $block['title'] = $module;
      $block['content'] = theme('item_list', $items);
      $block['description'] = t($description);

      if ($block_output = theme('admin_block', $block)) {
        if (!isset($block['position'])) {
          // Perform automatic striping.
          $block['position'] = $position;
          $position = $flip[$position];
        }
        $container[$block['position']] .= $block_output;
      }
    }
  }

  $output = '<div class="bymodule">';
  foreach ($container as $id => $data) {
    $output .= '<div class="'. $id .' clear-block">';
    $output .= $data;
    $output .= '</div>';
  }
  $output .= '</div>';

  return $output;
}
//  login line 
function phptemplate_flat_login() {
    global $user;
    if (!$user->uid) {
      $message= '<ul>
                  <li class="usericon">'.l(t('Sing in..'),'user/login', array('attributes' => array('rel'=>'nofollow')) ).'</li>
                  <li>'.l(t('New password'), 'user/password', array('attributes' => array('rel'=>'nofollow'))).'</li>
                  <li>'.l(t('Sign up'), 'user/register', array('attributes' => array('rel'=>'nofollow')) ).'</li>
                </ul>';
    } else {
      $message= '<ul>
                  <li class="usericon">'.l($user->name, 'user/'.$user->uid).'</li>
                  <li>'.l(t('Edit'), 'user/' . $user->uid . '/edit').'</li>
                  <li>'.l(t('Logout'), 'logout').'</li>
                </ul>';
    }
    return $message;
}
//  login line end