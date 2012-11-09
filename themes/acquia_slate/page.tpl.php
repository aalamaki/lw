<?php
// $Id: page.tpl.php,v 1.1 2009/02/28 23:33:58 jwolf Exp $
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
    <script type="text/javascript" language="JavaScript"><!--
	function HideContent(d) {
	if(d.length < 1) { return; }
	document.getElementById(d).style.display = "none";
	}
	function ShowContent(d) {
	if(d.length < 1) { return; }
	document.getElementById(d).style.display = "block";
	}
	function ReverseContentDisplay(d) {
	if(d.length < 1) { return; }
	if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }
	else { document.getElementById(d).style.display = "none"; }
	}
	//--></script>

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
      <?php endif; ?>

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

      <table style="margin-bottom: -1px; background: F6F8FA;"><tr>

      <?php if ($breadcrumb) { ?>
      <td style="font-size: 11px;">
      <?php print $breadcrumb; ?>
      </td><!-- /breadcrumb -->

      <?php

      }
      if($user->uid) { ?>

  <td style="text-align: right; font-size: 12px; margin: 3px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://www.linkweb24.com/user/<?php echo $user->uid; ?>">Oma tilini</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/logout">Kirjaudu ulos</a>&nbsp;&nbsp;&nbsp;&nbsp

        <?php

        }
        else {

        ?>

  <td style="text-align: right; font-size: 12px; margin: 3px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://www.linkweb24.com/user">Kirjaudu sis&auml;&auml;n</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/user/register">Rekister&ouml;idy</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/user/password">Pyyd&auml; uusi salasana</a>&nbsp;&nbsp;&nbsp;&nbsp;

        <?php

        }
	?>

  </td></tr></table>

    <div id="main-wrapper" class="clearfix">
        <?php if ($sidebar_first || $secondary_links): ?>
        <div id="sidebar-first">
          <?php if ($secondary_links): ?>
          <div id="secondary-menu">
            <?php print theme('links', $secondary_links); ?>
          </div><!-- /secondary_menu -->
          <?php endif; ?>
          <?php if ($sidebar_first): ?>
          <?php print $sidebar_first; ?>
          <?php endif; ?>
        </div><!-- /sidebar-first -->
        <?php endif; ?>
			<?php if ($tabs): ?>
            <div id="content-tabs" class="clear">
              <?php print $tabs; ?>
            </div>
            <?php endif; ?>         <div id="content-wrapper">
          <?php if ($messages): ?>
          <?php print $messages; ?>
          <?php endif; ?>
          <?php if ($help): ?>
          <?php print $help; ?>
          <?php endif; ?>
          <?php if ($content_top):?>
          <div id="content-top">
            <?php print $content_top; ?>
          </div><!-- /content-top -->
          <?php endif; ?>
          <div id="content">

	    <?php if($_GET['q'] == "custom_search") { ?>


<a
   onmouseover="ShowContent('uniquename'); return true;" onmouseout="HideContent('uniquename');return true;"
   href="javascript:ShowContent('uniquename')">
<img align="right" style="margin-right:20px; margin-top: -20px;" width="20" height="20" src="http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/help.png" alt="help"/>
</a>

        <div
		   id="uniquename" class="transparent"
		   style="display:none;
		      position:absolute;
		      left:740px;
		      top:190px;
		      margin: 0px; padding: 0px;
		      padding: 5px; z-index: 100;">
		      <div style="height: 58px; width: 200px; background: url('http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/test2.png') no-repeat;"><div style="font-weight: bold; color: #678091; font-size: 11px; padding-top: 28px; padding-left: 40px;">Kohdehaku</div></div>
		      <div style="width: 200px; background: url('http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/test3.png') repeat;"><div style="margin-left: 15px; margin-right: 15px; color: #678091; font-size: 10px;">Valitse v&auml;hint&auml;&auml;n yksi hakuehto n&auml;hd&auml;ksesi lyhennelm&auml;  kohteiden kuvauksesta. K&auml;ytt&ouml;oikeuksistasi riippuen saat lis&auml;tietoa kohteesta klikkaamalla 'Lis&auml;&auml; tietoa' linkki&auml;. <b>Huom. avainsana-kentt&auml;&auml;n vain yksi avainsana hakua kohti!</b></div></div>
		      <div style="min-height: 58px; width: 200px; background: url('http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/test4.png') no-repeat;"></div>
		</div>

        <?php }

        if($_GET['q'] == "myytavat_kohteet") { ?>


		<a
		   onmouseover="ShowContent('uniquename'); return true;" onmouseout="HideContent('uniquename');return true;"
		   href="javascript:ShowContent('uniquename')">
		<img align="right" style="margin-right:20px; margin-top: -20px;" width="20" height="20" src="http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/help.png" alt="help"/>
		</a>

		        <div
				   id="uniquename" class="transparent"
				   style="display:none;
				      position:absolute;
				      left:740px;
				      top:190px;
				      margin: 0px; padding: 0px;
				      padding: 5px; z-index: 100;">
				      <div style="height: 58px; width: 200px; background: url('http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/test2.png') no-repeat;"><div style="font-weight: bold; color: #678091; font-size: 11px; padding-top: 28px; padding-left: 40px;">Myyt&auml;v&auml;t kohteet</div></div>
				      <div style="width: 200px; background: url('http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/test3.png') repeat;"><div style="margin-left: 15px; margin-right: 15px; color: #678091; font-size: 10px;">T&auml;ll&auml; sivulla n&auml;et lyhennelm&auml;t k&auml;ytt&auml;jien asettamien myyntikoh- teiden kuvauksista. K&auml;ytt&ouml;oikeuk- sistasi riippuen saat lis&auml;tietoa kohteesta klikkaamalla 'Lis&auml;&auml; <br/>tietoa' linkki&auml;.</div></div>
				      <div style="min-height: 58px; width: 200px; background: url('http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/test4.png') no-repeat;"></div>
				</div>

        <?php }

        if($_GET['q'] == "ostoilmoitukset") { ?>


		<a
		   onmouseover="ShowContent('uniquename'); return true;" onmouseout="HideContent('uniquename');return true;"
		   href="javascript:ShowContent('uniquename')">
		<img align="right" style="margin-right:20px; margin-top: -20px;" width="20" height="20" src="http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/help.png" alt="help"/>
		</a>

		        <div
				   id="uniquename" class="transparent"
				   style="display:none;
				      position:absolute;
				      left:740px;
				      top:190px;
				      margin: 0px; padding: 0px;
				      padding: 5px; z-index: 100;">
				      <div style="height: 58px; width: 200px; background: url('http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/test2.png') no-repeat;"><div style="font-weight: bold; color: #678091; font-size: 11px; padding-top: 28px; padding-left: 40px;">Ostoilmoitukset</div></div>
				      <div style="width: 200px; background: url('http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/test3.png') repeat;"><div style="margin-left: 15px; margin-right: 15px; color: #678091; font-size: 10px;">T&auml;ll&auml; sivulla n&auml;et listan k&auml;ytt&auml;jien asettamista ostoilmoituksista. K&auml;yt- t&ouml;oikeuksistasi riippuen saat lis&auml;- tietoa kohteesta klikkaamalla  <br/>'Lis&auml;&auml; tietoa' linkki&auml;.</div></div>
				      <div style="min-height: 58px; width: 200px; background: url('http://webalt.mine.nu/drupal_6/themes/acquia_slate/images/test4.png') no-repeat;"></div>
				</div>

        <?php }

        ?>

		  <a name="main-content" id="main-content"></a>

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
    <?php print $closure; ?>
  </body>
</html>