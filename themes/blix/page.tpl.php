<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>">
<head>
    <title><?php print $head_title ?></title>
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <?php print $head ?>
    <?php print $styles ?>
    <?php print $scripts ?>
    <script type="text/JavaScript">
	function moviepic(src) {

        var src2 = 'http://www.linkweb24.com/sites/default/files/' + src;

        document.getElementById("popupimg1").src = "" + src2 + "";
    }
    </script>
</head>
<body <?php print theme("onload_attribute"); ?>>

<div id="container">
      <?php

		  if($user->uid) {

		  $roles = array();

		  foreach($user->roles as $val) {

			   $roles[] = $val;
		  }

		  if(in_array('myyjä_taso1_6kk', $roles) || in_array('myyjä_taso1_12kk', $roles) || in_array('myyjä_taso2_6kk', $roles) || in_array('myyjä_taso2_12kk', $roles) || in_array('myyjä_taso3_6kk', $roles) || in_array('myyjä_taso3_12kk', $roles) || in_array('katselija_laajennettu_6kk', $roles) || in_array('katselija_laajennettu_12kk', $roles) || in_array('ylläpitäjä', $roles)) {


			 if(!in_array('myyjä_taso1_6kk', $roles) && !in_array('myyjä_taso1_12kk', $roles) && !in_array('myyjä_taso2_6kk', $roles) && !in_array('myyjä_taso2_12kk', $roles) && !in_array('myyjä_taso3_6kk', $roles) && !in_array('myyjä_taso3_12kk', $roles)) {

             ?>

  			 <div style="position: relative; top: -25px; padding-left: 0px; text-align: right; font-size: 12px; margin: 3px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://www.linkweb24.com/node/add/ostoilmoitukset">Lisää osto-ilmoitus</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/own_buy">Muokkaa osto-ilmoituksia</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/user/<?php echo $user->uid; ?>">Oma tilini</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/logout">Kirjaudu ulos</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

	 	     <?php

		     }
		     else {

             ?>

  			 <div style="position: relative; top: -25px; padding-left: 0px; text-align: right; font-size: 12px; margin: 3px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://www.linkweb24.com/node/add/myytava-kohde">Lisää ilmoitus</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/own_content">Muokkaa ilmoituksia</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/user/<?php echo $user->uid; ?>">Oma tilini</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/logout">Kirjaudu ulos</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

             <?php

		     }
          }
          else if(in_array('ostaja', $roles)) {

          ?>

  			<div style="position: relative; top: -25px; padding-left: 0px; text-align: right; font-size: 12px; margin: 3px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://www.linkweb24.com/node/add/ostoilmoitukset">Lisää ostoilmoitus</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/own_buy">Muokkaa ostoilmoituksia</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/user/<?php echo $user->uid; ?>">Oma tilini</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/logout">Kirjaudu ulos</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

          <?php

          }
          else {

          ?>

  			<div style="position: relative; top: -25px; padding-left: 800px; text-align: right; font-size: 12px; margin: 3px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://www.linkweb24.com/user/<?php echo $user->uid; ?>">Oma tilini</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/logout">Kirjaudu ulos</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

          <?php

          }
        }
        else {

        ?>

  <div style="position: relative; top: -25px; padding-left: 620px; text-align: right; font-size: 12px; margin: 3px; font-color: #000000; font-family: Verdana; font-weight: normal;"><a href="http://www.linkweb24.com/user">Kirjaudu sis&auml;&auml;n</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/user/register">Rekister&ouml;idy</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.linkweb24.com/user/password">Pyyd&auml; uusi salasana</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

        <?php

        }
	?>

<!-- /breadcrumb -->

  <a href="http://www.linkweb24.com">
  <div id="header" style="margin-top: -25px;">

  </div>
  </a>

  <div id="navigation">
    <?php if ($search_box): ?>
		<?php print $search_box ?>
    <?php endif; ?>
    <?php if (isset($primary_links)) : ?>
      <?php print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
    <?php endif; ?>
  </div>
<hr class="low" />
  <div id="content">
    <div class="navigation"> <?php print $breadcrumb ?> </div>
    <?php if ($messages != ""): ?>
    	<div id="message"><?php print $messages ?></div>
    <?php endif; ?>
    <?php if ($mission != ""): ?>
    	<div id="mission"><?php print $mission ?></div>
    <?php endif; ?>
    <?php if ($title != ""): ?>
    	<h1 class="page-title"><?php print $title ?></h1>
    <?php endif; ?>
    <?php if ($tabs != ""): ?>
    	<?php print $tabs ?>
    <?php endif; ?>
    <?php if ($help != ""): ?>
    	<p id="help"><?php print $help ?></p>
    <?php endif; ?>
    <!-- start main content -->
    <?php print($content) ?>
    <!-- end main content -->
  </div>
  <div id="subcontent">
    <?php print $left ?> <?php print $right ?>
  </div>
 <hr class="low" />
  <div id="footer">
      <?php if ($footer_message) : ?>
      	<p><?php print $footer_message;?><?php print $footer ?></p><br />
      <?php endif; ?>
       Copyright &copy; 2009 LinkWeb<sup><span style="font-size: 9px;">24</span></sup> Oy
  </div>
</div>
<?php print $closure;?>
</body>
</html>