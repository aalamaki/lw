<html>
<head>
<title><?php echo $_GET['video']; ?></title>
</head>
<body style="margin: 0px;">


<embed
src="http://player.longtailvideo.com/player.swf"
width="450"
height="300"
allowscriptaccess="always"
allowfullscreen="true"
flashvars="autostart=true&height=250&width=400&file=http://webalt.mine.nu/drupal_6/sites/default/files/<?php echo $_GET['video']; ?>&backcolor=0xAAAAAA&frontcolor=0x3333FF&lightcolor=0xCCFFFF&screencolor=0x000000"
/>

</body>
</html>