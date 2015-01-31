<?php
include_once 'client/facebook.php';
include_once 'config.php';
include_once 'lib.php';

$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user = $facebook->require_login();

// Echo the "infinite session key" that everyone keeps talking about.
echo $facebook->api_client->session_key;
?>
