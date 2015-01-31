<?php

function fGetTwitterStatus($strCount)
{

	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, "http://twitter.com/statuses/user_timeline/simplyearl.json?count=" . $strCount);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$strResult = curl_exec ($ch);
	curl_close ($ch);
	preg_match("/\"(text)\":\"(.*?)\"/i", $strResult, $arrResults);
	
	if (count($arrResults) < 2)
	{ $strReturn = 'No one knows what I\'m doing.'; }
	else
	{ $strReturn = $arrResults[2]; }
	return $strReturn;
}

?>

<h2><?php echo fGetTwitterStatus('1') ?></h2>
<p><a href="http://twitter.com/simplyearl" title="Stay Updated via Twitter" target="_blank">Read more via Twitter</a></p>
