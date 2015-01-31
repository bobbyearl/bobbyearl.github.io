<?php

include 'fb/facebook.php';

$api_key = 'e59c32974d9a3136017900df131704c7';
$secret  = '8d6e4b2d26b7283c473cd23d635220df';
$key = 'acaa9e7ae3c4e3ea99f107d2-45500018';

$facebook = new Facebook($api_key, $secret);
$facebook->set_user($bobby, $key);

$arrPhotos = $facebook->api_client->photos_get(45500018,'','');

/*
for ($intI = 0; $intCounter < count($arrPhotos); $intI++)
{
	echo $arrPhotos[$intI]['src_big'] . "<br />\n";	
}
*/

echo count($arrPhotos) . '<br />';
foreach ($arrPhotos as $photo)
	echo $photo['src_big'] . '<br />';

?>
