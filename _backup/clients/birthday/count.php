<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" x-undefined>
<title>User &amp; Attachment Statistics</title>
</head>

<body>

<?php

include_once 'config.php';
include_once 'lib.php';

$conn = mysql_connect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass']) or die ('Error connecting to mysql');
mysql_select_db($GLOBALS['dbname']);
	
$query = 'SELECT count(fbid) from users';
$result = mysql_query($query);

if ($result)
{ echo '<p>' . mysql_result($result,0) . ' total installs</p>'; }

$query = 'SELECT count(fbid) from users where installed = 1';
$result = mysql_query($query);

if ($result)
{ echo '<p>' . mysql_result($result,0) . ' currently installed</p>'; }

$query = 'SELECT count(fbid) from attachments';
$result = mysql_query($query);

if ($result)
{ echo '<p>' . mysql_result($result,0) . ' attachments</p>'; }

?>

<p><a href="https://www.google.com/analytics/reporting/dashboard?id=2830020&scid=460794" target="_blank">Google Analytics</a></p>
<p><a href="https://www.google.com/adsense/report/overview" target="_blank">Google Adsense</a></p>
<p><a href="http://winthrop.facebook.com/apps/application.php?id=4671109309" target="_blank">Birthday Card Discussion</a></p>
<p><a href="http://winthrop.facebook.com/developers/editapp.php?edit&app_id=4671109309" target="_blank">Birthday Card Settings</a></p>
<p><a href="http://winthrop.facebook.com/developers/" target="_blank">Facebook Developer</a></p>
<p><a href="http://wiki.developers.facebook.com/index.php/Main_Page" target="_blank">Facebook Wiki</a></p>
</body>
</html>
