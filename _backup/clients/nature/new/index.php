<?php

require_once('config.php');

if (!is_dir($artwork_gallery)) die('Artwork gallery does not exist.');
if (!($handle = opendir($artwork_gallery))) die('Unable to read artwork gallery.');

while (false !== ($file = readdir($handle))) {
	if (!is_dir($file)) $output .= '<li><a href="' . $artwork_gallery . $file . '"><img src="' . sprintf($thumbnail_creator, $file) . '" /></a></li>' . PHP_EOL;
}

if ($output) $output = '<ul>' . PHP_EOL . $output . '</ul>' . PHP_EOL;
else $output = '<p>Unable to locate any artwork.</p>';
?>









<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"> 
<head>
<title>William C. Alexander Photography</title>
<link rel="stylesheet" type="text/css" href="css/screen.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/lightbox.css" media="screen" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.lightbox.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</head>
<body>


<div id="header" class="clearfix">
<div class="frame">
<h1 class="title">William C. Alexander Photography</h1>
<p class="cart">Ability to purchase photos coming soon.</p>
</div>
</div>


<div id="container" class="clearfix">
<div id="artwork" class="frame">
<?php echo $output; ?>
</div>
</div>


<div id="footer" class="clearfix">
<div class="frame">
<p class="page">Page 1 of 1</p>
<p class="info">Click Thumbnails for Larger View</p>
</div>
</div>


</body>
</html>
