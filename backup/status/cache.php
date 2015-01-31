<?php

function loadURL($url) {
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close ($ch);
	
	return $result;
}

function readCache($cacheFile) {

	if(!file_exists($cacheFile))
		return false;

	$fp = @fopen($cacheFile, "r");
	$buffer = "";

	if(!$fp) {
		return false;
	} else {
		while(!feof($fp)) {
			$buffer .= fgets($fp,4096);
		}
	}

	fclose($fp);
	return $buffer;
}

function saveCache($cacheFile, $data) {

	$fp = @fopen($cacheFile,"w");

	if(!$fp)
		return false;

	fwrite($fp,$data);
	fclose($fp);
}

function getCacheLastModified($cacheFile) {
	return @filemtime($cacheFile);			
}

?>