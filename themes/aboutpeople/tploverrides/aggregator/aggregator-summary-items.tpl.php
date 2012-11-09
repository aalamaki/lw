<?php
// $Id: aggregator-summary-items.tpl.php,v 1.1 2008/08/04 16:46:37 slasant Exp $

//aboutpeople template for feed summary
?>

<h2><?php print $title; ?></h2>
<div class="feedsummary"
<?php print $summary_list; ?>
<div class="links">
  <a href="<?php print $source_url; ?>"><?php print t('More'); ?></a>
</div>

</div>