<?php

include_once 'client/facebook.php';
include_once 'config.php';
include_once 'lib.php';

$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user = $facebook->require_login();

// Record User
fRecordUser();

$today = date("F j");
$tomorrow = date("F j", mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
$this_month = date("F", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

$fql = "Select uid, birthday, name, pic_square from user where strpos(birthday, '%s') == 0 and uid IN (SELECT uid2 FROM friend WHERE uid1 = " . $user . ")";
$birthdays_today = $facebook->api_client->fql_query(sprintf($fql, $today));
$birthdays_tomorrow = $facebook->api_client->fql_query(sprintf($fql, $tomorrow));
$birthdays_this_month = $facebook->api_client->fql_query(sprintf($fql, $this_month));

if (strcmp($birthdays_today,'') != 0)
{ usort($birthdays_today, "cmp"); }

if (strcmp($birthdays_tomorrow,'') != 0)
{ usort($birthdays_tomorrow, "cmp"); }

if (strcmp($birthdays_this_month,'') != 0)
{ usort($birthdays_this_month, "cmp"); }

?>

<fb:iframe src="http://simplyearl.com/birthday/analytics.php?t=FB:Birthday_Home" frameborder=0 style="height: 1px; width: 1px;"></fb:iframe>

<style type="text/css">
	h2 {
		border-bottom: solid 1px #B7B7B7; }

	p {
		padding: 5px 0; }

	ul {
		list-style: none; 
		margin: 0; 
		padding: 0; }

	ol li {
		float: left;
		padding: 5px; }

	.bWrapper {
		padding: 20px; }

	.bGroup {
		padding: 0 0 10px 0; }

	.bUser {
		float: left; 
		list-style: none; 
		padding: 10px;
		text-align: center; 
		width: 100px; }
</style>

<div class="bWrapper">
	<div class="clearfix" style="padding-bottom: 10px;">
		<h1 style="float: left">Hi <fb:name firstnameonly="true" uid="<?=$user?>" useyou="false"/>!  Welcome to The Birthday Card Application	</h1>
		<div style="float: right"><a href="http://winthrop.facebook.com/apps/application.php?id=4671109309">More Information</a></div>
	</div>

	<fb:if-user-has-added-app>

		<div class="clearfix" style="border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; background: #EFEFEF; padding: 10px;">
			<div style="float: left">
				<p><strong>Step 1:</strong> Click Friend Below</p>
				<p><strong>Step 2:</strong> Click Attach Birthday Card</p>
				<p><strong>Step 3:</strong> Choose Birthday Card</p>
				<p><strong>Step 4:</strong> Attach To Wall</p>
				<p><strong>Step 5:</strong> Have Great Success</p>
				<p><a href="http://winthrop.facebook.com/apps/application.php?id=4671109309">More Information</a></p>
			</div>
			<div style="float: right; text-align: center; width: 300px;">
				<fb:iframe src="http://simplyearl.com/birthday/ads.php" scrolling=no frameborder=0 style="height: 210px; width: 210px;"></fb:iframe>
			</div>
		</div>
	
		<div class="bGroup clearfix" style="padding-top: 10px;">
			<p><strong>Don't see your friend below?  You can still send them a birthday card by visiting their wall.<br /><a href="http://www.facebook.com/friends.php">View all your friends</a>.</strong></p>
			<h2>Today's Birthdays</h2>
			<?php echo fGenerateUserList($birthdays_today) ?>
		</div>
	
		<div class="bGroup clearfix">
			<h2>Tomorrow's Birthdays</h2>
			<?php echo fGenerateUserList($birthdays_tomorrow) ?>
		</div>
	
		<div class="bGroup clearfix">
			<h2>Birthday's This Month</h2>
			<?php echo fGenerateUserList($birthdays_this_month) ?>
		</div>
	
	<fb:else>
	
		<p>You must add this application in order to use it.  <a href="http://winthrop.facebook.com/apps/application.php?id=4671109309">Learn More</a></p>
	
		<h1><a href="http://winthrop.facebook.com/add.php?api_key=e59c32974d9a3136017900df131704c7">Add Application Now</a></h1>

	</fb:else>

	</fb:if-user-has-added-app>

</div>



