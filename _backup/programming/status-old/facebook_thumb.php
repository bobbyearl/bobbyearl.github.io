<?php

	// Do We Have Cache?
	$strAid = $_GET['aid'];
	$strPid = $_GET['pid'];
	
	$strCache = 'cache/' . $strAid . '-' . $strPid . '.jpg';
	
	// Does Cache Exist?
	if (!file_exists($strCache))
	{
		// Content type
		//header('Content-type: image/jpeg');

		// Dimensions
		$new_width = 75;
		$new_height = 75;
		
		$ch = curl_init($_GET['i']);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	
		// Grab the jpg and save the contents in the $data variable
		$data = curl_exec($ch);
	
		// close the connection
		curl_close($ch);
		
		// Load
		$tmp = imagecreatefromstring($data);
		$thumb = imagecreatetruecolor($new_width, $new_height);
	
		// Original Dimensions
		$width = imagesx($tmp);
		$height = imagesy($tmp);
	
		$wPoint = ($width - $new_width) / 2;
		$hPoint = ($height - $new_height) / 2;
	
		// Resize
		imagecopyresampled($thumb, $tmp, 0, 0, $wPoint, $hPoint, $new_width, $new_height, $new_width, $new_height);

		// Save File
		imagejpeg($thumb, $strCache);

		// Cleanup	
		imagedestroy($tmp);
		imagedestroy($thumb);
	}

	// Image MUST Exist Now
	header('Location: http://simplyearl.com/status/' . $strCache);			
?>