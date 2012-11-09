<div class="entry<?php print ($sticky) ? " sticky" : ""; ?>">

  <?php if ($page == 0): ?>

  <?php if($_SERVER['REQUEST_URI'] != '/drupal_6/') { ?>
  <h2><a href="<?php print $node_url ?>" rel="bookmark" title="Permanent Link to <?php print $title ?>"><?php print $title ?></a></h2>

  <?php } else { ?>


  <?php } ?>

  <?php endif; ?>

  <?php print $content ?>
  <?php if ($links): ?>

  <?php if((substr_count($_SERVER['REQUEST_URI'], 'myytavat_kohteet') != NULL) && (substr_count($_SERVER['REQUEST_URI'], 'ostoilmoitukset') != NULL) || (substr_count($_SERVER['REQUEST_URI'], 'kayttoehdot') != NULL)) {

  	print $links;

  	}

  	?></p>
  <?php endif; ?>
</div>

<hr class="low" />