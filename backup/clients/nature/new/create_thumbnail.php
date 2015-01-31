<?php
/*
	1. Verify source image.
	2. If thumb doesn't exist, create and save thumb.
	3. Read and display thumb.
*/

require_once('config.php');

$src = isset($_GET['src']) ? $_GET['src'] : null;
if (!$src) die('SRC is required.');
if (strpos($src, '..') !== false) die('Tisk Tisk.  You can\'t go up silly goose.');

if (!file_exists($thumbnail_gallery . $src)) {
	$tmp = imagecreatefromjpeg($artwork_gallery . $src);
	$thumb = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
	$width = imagesx($tmp);
	$height = imagesy($tmp);
	imagecopyresized($thumb, $tmp, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $width, $height);
	imagejpeg($thumb, $thumbnail_gallery . $src);
	imagedestroy($tmp);
	imagedestroy($thumb);
}

header('Location: ' . $thumbnail_gallery . $src);
?>
