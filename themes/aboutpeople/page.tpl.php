<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
    <!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="<?php print base_path(). path_to_theme(); ?>/iestyles/ie6.css" />
<![endif]-->
  <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="<?php print base_path(). path_to_theme(); ?>/iestyles/ie7.css" />
<![endif]-->
  <?php print $scripts ?>
</head>
<body>
<noindex><div id="megatopregion">
<?php if ($header): ?>
         <div id="headerblock">
                  <?php print $header; ?>
        </div>
       <?php endif; ?>
<div class="drdot">
<hr />
</div></div></noindex>

<div id="page">
         <div width="100%" style="text-align: right; font-family: arial; font-size: 10px; color: #000000;"><?php print $breadcrumb; ?></div>
  <div id="header">
<?php if ($logo) {
              print '<img src="'. check_url($logo) .'" alt="'. $site_name .'" id="logo" />';
            }
			?>
   <?php if ($site_name) : ?>
 <?php if ($is_front) : /* if we are on the front page use <h1> for site title */ ?>
 <h1 class="sitetitle"> <a href="<?php print $base_path ?>" title="<?php print t('Home') ?>">
	        <?php print $site_name ?>
	      </a>
	    </h1>
 <?php endif; ?>
 <?php if (!$is_front) : /* otherwise use <p> and let node title use <h1> for SEO */ ?>
  <p class="sitetitle">
	      <a href="<?php print $base_path ?>" title="<?php print t('Home') ?>">
	        <?php print $site_name ?>
	      </a>
	    </p>

 <?php endif; ?>
	  <?php endif; ?>
 <?php if ($site_slogan){?>
<p class="slogan"><?php print $site_slogan ?></p>
<?php } ?>
  </div>
  <div id="utilities">
    <div id="utilities_corner">
  <?php print $search_box ?>
  <?php if (isset($primary_links)) : ?>
  <?php print '<div id="plinks">'; ?>
          <?php print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
          <?php print '</div>'; ?>

  <?php global $user;

  if($user->uid) {

  ?>

  <div style="text-align: right; font-size: 12px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://webalt.mine.nu/drupal_6/?q=user/<?php echo $user->uid; ?>">Oma tilini</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://webalt.mine.nu/drupal_6/?q=logout">Kirjaudu ulos</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
        <?php

        }
        else {

        ?>

  <div style="text-align: right; font-size: 12px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://webalt.mine.nu/drupal_6/?q=user/register">Rekister&ouml;idy</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://webalt.mine.nu/drupal_6/?q=user/password">Pyyd&auml; uusi salasana</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

        <?php

        }
        endif; ?>
 </div> </div>         <?php if (($secondary_links)) : ?>
      <?php print '<div id="submenu">' ?>
          <?php print theme('links', $secondary_links, array('class' => 'links secondary-links')) ?>
          <?php print '</div><div class="stopfloat"></div>' ?>
        <?php endif; ?>
  <div class="wrapper"><!--wrapper:defines whole content margins-->
    <div id="primary" style=<?php print '"width:'.aboutpeople_width( $left, $right).'px;">' ?>
               <div class="singlepage">
   <?php if ($mission): print '<div id="sitemission"><p>'. $mission .'</p></div>'; endif; ?>
              <?php if ($content_top): ?>
            <?php print $content_top; ?>
         <!-- /#content-top -->
<?php endif; ?>
         <?php
		 if ($title):
		 if ($is_front){/* if we are on the front page use <h2> for title */
		 print '<h2'. ($tabs ? ' class="with-tabs"' : '') .'>'. $title .'</h2>';
		 }
		else {print '<h1'. ($tabs ? ' class="with-tabs"' : '') .'>'. $title .'</h1>';  /* otherwise use <h1> for node title */
		 }
		 endif; ?>
          <?php if ($tabs): print '<div class="tabs">'.$tabs.'</div>'; endif; ?>
        <?php if ($help) { ?><div class="help"><?php print $help ?></div><?php } ?>
          <?php if ($messages) { ?><div class="messages"><?php print $messages ?></div><?php } ?>
<div class="drdot">
<hr />
</div>
 <?php print $content ?>
      </div>
    </div>
        	<!-- left -->
        <?php if ($left) { ?>
          <div class="lsidebar">
            <?php print $left ?>
          </div><!-- end left -->
        <?php } ?>
   	<!-- right -->
        <?php if ($right) { ?>
          <div class="rsidebar">
            <?php print $right ?>
          </div><!-- end right -->
        <?php } ?>
 <div class="clear"></div>
  </div>
</div>
<!-- Close Page -->
<div id="footer">
<?php print $footer ?>
<?php print $footer_message ?>
</div>
<?php print $closure ?>
</body>
</html>