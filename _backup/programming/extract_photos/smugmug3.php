<?php

/* 

This programs expects the html source from the smugmug gallery.  To get all the thumbnails on one screen, in the upper right corner change the theme to "All Thumbs".

*/

/* Variable Declaration */
$dir = 'molly/';
$source = 'molly_engagement.htm';
$url = 'http://moodphotography.smugmug.com/Weddings/Friddle-Engagements/';
$thumb = '-Th.jpg';
$full = '-O.jpg';

$regexp = '/' . str_replace('/', '\/', $url) . '(.*)' . $thumb . '/';
$total = 0;
$total_needed = 0;


/* Open HTML File */
$contents = file_get_contents('./' . $dir . $source);

/* Extract Photos */
$total = preg_match_all($regexp, $contents, $photos);

/* Save Photos To Images Folder */
foreach ($photos[1] as $photo) {
	$photo_wo_dirs = str_replace('/', '_', $photo);

	if (!file_exists($dir . $photo_wo_dirs . $full)) {
		$total_needed++;
		$output .= $photo_wo_dirs . ' needs saving.<br />' . "\n";
		$wget .= 'wget ' . $url . $photo . $full . ' -O ' . $dir . $photo_wo_dirs . $full . "\n";
	} else {
		$output .= $photo_wo_dirs . ' already saved.<br />' . "\n";
	}
}

echo '<textarea>' . $wget . '</textarea><br />';
echo 'Found ' . $total . ' photos. ' . $total_needed . ' need saving.<br />';
echo $output;
?>
