<?php

include 'facebookapi.php';

function fGetFacebookPhotos($strCount)
{
	$api_key = 'e59c32974d9a3136017900df131704c7';
	$secret  = '8d6e4b2d26b7283c473cd23d635220df';
	//$key = 'ba3db7c97a3da15350d77484-45500018';
	$key = 'acaa9e7ae3c4e3ea99f107d2-45500018';
	$ashley = '45500234';
	$bobby = '45500018';
	$strReturn = '';
	$intCounter = 0;
	
	$facebook = new Facebook($api_key, $secret);
	$facebook->set_user($bobby, $key);
	
	$arrAshley = $facebook->api_client->photos_get($ashley,'','');
	$arrBobby = $facebook->api_client->photos_get($bobby,'','');
	
	for ($intI = 0; $intCounter < $strCount; $intI++)
	{
		// Ashley or Bobby
		if ($intCounter % 2 == 1)
		{ $arrCurrent = $arrAshley; }
		else
		{ $arrCurrent = $arrBobby; }
		
		// Read Values From Current Array
		$strImage = $arrCurrent[$intI]['src']; 
		$strLink = $arrCurrent[$intI]['link']; 
		$strCaption = $arrCurrent[$intI]['caption'];
		$strAid = $arrCurrent[$intI]['aid'];
		$strPid = $arrCurrent[$intI]['pid'];

		// Remove Duplicates
		if (!stristr($strReturn,$strImage))
		{
			// Update Counter
			$intCounter++;
			
			// Determine Caption
			if ($strCaption == "")
			{ $strCaption = "Recent Facebook Photo " . $intCounter; }
			
			// Cached Image
			$strCache = 'cache/' . $strAid . '-' . $strPid . '.jpg';
			
			// Read From Cache Or Thumb
			if (!file_exists($strCache))
			{ $strUrl = '/status/facebook_thumb.php?aid=' . $strAid . '&pid=' . $strPid . '&i=' . $strImage; }
			else
			{ $strUrl = '/status/' . $strCache; }
			
			// Add Image
			$strReturn .= '<a href="' . $strLink . '" target="_blank" title="' . $strCaption . '"><img src="' . $strUrl . '" alt="' . $strCaption . '" /></a>';
		}
	}
	
	return $strReturn;

}

?>

<h2><a href="http://www.facebook.com/photo_search.php?id=45500018" target="_blank">Recent Facebook Photos</h2>
<p><?php echo fGetFacebookPhotos('10'); ?></p>