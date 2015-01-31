<?php

// Get these from http://developers.facebook.com
$api_key = 'e59c32974d9a3136017900df131704c7';
$secret  = '8d6e4b2d26b7283c473cd23d635220df';

$debug_api_key = 'e0cca2c61052c9e2c8a3a522c5c8a72c';
$debug_secret = '65c950d4844ed0fc6209236a03a7744c';

$dbhost = 'birthdaybuddy.simplyearl.com';
$dbuser = 'birthdaybuddy';
$dbpass = 'winthrop';
$dbname = 'birthdaybuddy';

// Birthday Card Arrays
$arrCards = array(
	array('clipart', 'f00.jpg'), array('clipart', 'f01.jpg'),
	array('funny', 'f02.jpg'), array('funny', 'f03.jpg'),
	array('funny', 'f04.jpg'), array('funny', 'f05.jpg'),
	array('funny', 'f06.jpg'), array('funny', 'f07.jpg'),
	array('funny', 'f08.jpg'), array('funny', 'f09.jpg'),
	array('funny', 'f10.jpg'), array('funny', 'f11.jpg'),
	array('funny', 'f12.jpg'), array('funny', 'f13.jpg'),
	array('funny', 'f14.jpg'), array('funny', 'f15.jpg'),
	array('funny', 'f16.jpg'), array('funny', 'f17.jpg'),
	array('funny', 'f18.jpg'), array('funny', 'f19.jpg'),
	array('funny', 'f20.jpg'), array('funny', 'f21.jpg'),
	array('funny', 'f22.jpg'), array('funny', 'f23.jpg'),
	array('funny', 'f24.jpg'), array('funny', 'f25.jpg'),
	array('funny', 'f26.jpg'), array('funny', 'f27.jpg'),
	array('funny', 'f28.jpg'), array('funny', 'f29.jpg'),
	array('funny', 'f30.jpg'), array('funny', 'f31.jpg'),
	array('funny', 'f32.jpg'), array('funny', 'f33.jpg'),
	array('funny', 'f34.jpg'), array('funny', 'f35.jpg'),
	array('funny', 'f36.jpg'), array('funny', 'f37.jpg'),
	array('funny', 'f38.jpg'), array('funny', 'f39.jpg'),
	array('funny', 'f40.jpg'), array('clipart', 'f41.gif'),
	array('clipart', 'f42.gif'), array('sexy', 'f43.jpg'),
	array('pets', 'f44.jpg'), array('funny', 'f45.jpg'),
	array('funny', 'f46.jpg'), array('pets', 'f47.jpg'),
	array('flash', 'f48.swf'), array('flash', 'f49.swf'),
	array('flash', 'f50.swf'), array('flash', 'f51.swf'),
	array('flash', 'f52.swf'), array('flash', 'f53.swf'),
	array('flash', 'f54.swf'), array('flash', 'f55.swf'),
	array('flash', 'f56.swf'), array('pets', 'f57.gif'),
	array('funny', 'f58.jpg'), array('sincere', 'f59.jpg'),
	array('funny', 'f60.gif'), array('funny', 'f61.jpg'),
	array('funny', 'f62.jpg'), array('funny', 'f63.jpg'),
	array('pets', 'f64.jpg'), array('pets', 'f65.jpg'),
	array('pets', 'f66.jpg'), array('pets', 'f67.jpg'),
	array('pets', 'f68.jpg'), array('pets', 'f69.jpg')	
);

// Reusable String Formats
$strImage = '<img src="http://earlr.people.cofc.edu/birthday/img/%1$s" alt="Card %1$s" %2$s />';
$strFlash = '<fb:swf swfsrc="http://earlr.people.cofc.edu/birthday/img/%1$s" height="256" width="320" salign="" loop="false" imgstyle="height: 256px; width:320px;" imgsrc="http://earlr.people.cofc.edu/birthday/img/flash.jpg"></fb:swf>';
