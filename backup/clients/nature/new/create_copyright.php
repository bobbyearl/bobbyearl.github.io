<?php

//require_once('../config.php');
$artwork_gallery = 'artwork/';
$copyright_text = 'Copyright William C. Alexander';
$copyright_width = 300;
$copyright_height = 30;
$copyright_alpha = 25;

$src = isset($_GET['src']) ? str_replace($artwork_gallery, '', $_GET['src']) : null;
$src_with_location = $artwork_gallery . $src;

if (!$src) die('SRC is required.');
if (strpos($src,'..') !== false) die('Tisk Tisk.  No need to move up.');
if (!file_exists($src_with_location)) die('Unable to locate: ' . $src_with_location);

$src = 'copyright/' . $src;

if (!file_exists($src)) {
	$merged = imagecreatefromjpeg($src_with_location);
	$copyright = imagecreatetruecolor($copyright_width, $copyright_height);

	/*
	$text_color = imagecolorallocate($copyright, 
		'0x' . substr($copyright_color,0,2), 
		'0x' . substr($copyright_color,2,2), 
		'0x' . substr($copyright_color,4,2));
	*/

	$text_color = imagecolorallocate($copyright, 255, 255, 255);
	imagestring($copyright, 1, 5, 5,  $copyright_text, $text_color);
	list($src_width, $src_height) = getimagesize($src_with_location);

	for ($i = 0; $i <= floor($src_width/$copyright_width); $i++) {
	for ($j = 0; $j <= floor($src_height/$copyright_height); $j++) {
		imagecopymerge($merged, $copyright, ($copyright_width * $i), ($copyright_height * $j), 0, 0, $copyright_width, $copyright_height, $copyright_alpha);
	}
	}

	imagejpeg($merged,$src);
	imagedestroy($copyright);
	imagedestroy($merged);
}

header('Content-type: image/jpeg');
$im = imagecreatefromjpeg($src);
imagejpeg($im);
imagedestroy($im);
?>
