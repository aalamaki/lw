<?php
// $Id: page-front.tpl.php,v 1.1 2009/02/28 23:33:58 jwolf Exp $
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">

  <head>
    <title><?php print $head_title; ?></title>
    <?php print $head; ?>
    <?php print $styles; ?>
    <!--[if IE 7]>
      <link rel="stylesheet" href="<?php print $base_path . $directory; ?>/ie7-fixes.css" type="text/css">
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel="stylesheet" href="<?php print $base_path . $directory; ?>/ie6-fixes.css" type="text/css">
    <![endif]-->
    <?php print $scripts; ?>
  </head>

  <body class="<?php print $body_classes; ?>">
    <div id="page">
      <?php if ($content): ?>
      <div id="skip">
        <a href="#main-content"><?php print t('Skip to Main Content'); ?></a>
      </div>
      <?php endif; ?>
      <?php if ($banner): ?>
      <div id="banner" class="clearfix">
        <?php print $banner; ?>
      </div><!-- /banner -->
      <?php endif; ?>
      <?php if ($header_top): ?>
      <div id="header-top" class="clearfix">
        <?php print $header_top; ?>
      </div><!-- /header-top -->
      <?php endif;

      if($user->uid) {

?>

      <table style="margin-bottom: -1px;"><tr>

<?php

      if ($breadcrumb): ?>
      <td style="font-size: 11px;">
      <?php print $breadcrumb; ?>
      </td><!-- /breadcrumb -->
      <?php endif;

      ?>

  <td style="text-align: right; font-size: 12px; margin: 3px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://webalt.mine.nu/drupal_6/?q=user/<?php echo $user->uid; ?>">Oma tilini</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://webalt.mine.nu/drupal_6/?q=logout">Kirjaudu ulos</a>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>
        <?php

        }
        else {

        ?>

  <td style="text-align: right; min-width: 959; font-size: 12px; margin: 3px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://webalt.mine.nu/drupal_6/?q=user">Kirjaudu sis&auml;&auml;n</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://webalt.mine.nu/drupal_6/?q=user/register">Rekister&ouml;idy</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://webalt.mine.nu/drupal_6/?q=user/password">Pyyd&auml; uusi salasana</a>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>

        <?php

        }
	?>
      <div id="header-wrapper" class="clearfix">
        <div id="header-first">
          <?php if ($logo): ?>
          <div id="logo">
            <a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><img src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a>
          </div>
          <?php endif; ?>
          <?php if ($site_name): ?>
          <h1><a href="<?php print $base_path ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a></h1>
          <?php endif; ?>
        </div><!-- /header-first -->
        <div id="header-middle">
          <?php if ($site_slogan): ?>
          <div id="slogan">
            <?php print $site_slogan; ?>
          </div>
          <?php endif; ?>
          <?php if ($header_middle): ?>
          <?php print $header_middle; ?>
          <?php endif; ?>
        </div><!-- /header-middle -->
      <?php if ($primary_links): ?>
        <div id="primary-menu">
          <?php print theme('links', $primary_links); ?>
        </div><!-- /primary_menu -->
      <?php endif; ?>
      </div><!-- /header-wrapper -->
      <?php if ($preface_sidebar || $mission) : ?>
      <div id="preface-wrapper" class="clearfix">
        <?php if ($preface_sidebar): ?>
          <div id="preface-sidebar">
            <?php print $preface_sidebar; ?>
          </div>
        <?php endif; ?>
        <?php if ($mission): ?>
          <div id="mission">
            <?php print $mission; ?>
          </div>
        <?php endif; ?>
      </div><!-- /preface-wrapper -->
      <?php endif; ?>
      <div id="main-wrapper" class="clearfix">
        <?php if ($sidebar_first): ?>
        <div id="sidebar-first">
          <?php print $sidebar_first; ?>
        </div><!-- /sidebar-first -->
        <?php endif; ?>
          <div id="content-wrapper">
          <?php if ($messages): ?>
          <?php print $messages; ?>
          <?php endif; ?>
          <?php if ($help): ?>
          <?php print $help; ?>
          <?php endif; ?>
          <div id="content">
            <a name="main-content" id="main-content"></a>
            <?php if ($tabs): ?>
            <div id="content-tabs" class="clear">
              <?php print $tabs; ?>
            </div>
            <?php endif; ?>
            <?php if ($content || $title): ?>
            <div id="content-inner" class="clear">
              <?php if ($title): ?>
              <h1 class="title"><?php print $title; ?></h1>
              <?php endif; ?>
              <?php if ($content): ?>
              <?php print $content; ?>
              <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if ($content_bottom): ?>
            <div id="content-bottom">
              <div class="corner top-right"></div>
              <div class="corner top-left"></div>
              <div class="inner">
              <?php print $content_bottom; ?>
              </div>
              <div class="corner bottom-right"></div>
              <div class="corner bottom-left"></div>
            </div><!-- /content-bottom -->
            <?php endif; ?>
          </div><!-- /content -->
        </div><!-- /content-wrapper -->
        <?php if ($sidebar_last): ?>
        <div id="sidebar-last">
          <?php print $sidebar_last; ?>
        </div><!-- /sidebar_last -->
        <?php endif; ?>
      </div><!-- /main-wrapper -->
    </div><!-- /page -->
    <?php if ($postscript_first || $postscript_middle || $postscript_last): ?>
    <div id="postscripts">
      <div id="postscript-wrapper" class="<?php print $postscripts; ?> clearfix">
        <?php if ($postscript_first): ?>
        <div id="postscript-first" class="column">
          <?php print $postscript_first; ?>
        </div><!-- /postscript-first -->
        <?php endif; ?>
        <?php if ($postscript_middle): ?>
        <div id="postscript-middle" class="column">
          <?php print $postscript_middle; ?>
        </div><!-- /postscript-middle -->
        <?php endif; ?>
        <?php if ($postscript_last): ?>
        <div id="postscript-last" class="column">
          <?php print $postscript_last; ?>
        </div><!-- /postscript-last -->
        <?php endif; ?>
      </div><!-- /postscript-wrapper -->
    </div><!-- /postscripts -->
    <?php endif; ?>
    <?php if ($footer || $footer_message): ?>
    <div id="footer" class="clearfix">
      <div id="footer-wrapper">
        <?php if ($footer_message): ?>
        <div id="footer-message">
          <?php print $footer_message; ?>
        </div>
        <?php endif; ?>
        <?php if ($footer) : ?>
          <div id="footer-region">
            <?php print $footer; ?>
          </div>
        <?php endif; ?>
      </div><!-- /footer-wrapper -->
    </div><!-- /footer -->
    <?php endif; ?>
  </body>
</html>