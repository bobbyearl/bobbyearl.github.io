<?php

include_once 'client/facebook.php';
include_once 'config.php';
include_once 'lib.php';
$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user = $facebook->require_login();

// Record User
fRecordUser();

// Get Timezone Offset
$fql = 'Select timezone from user where uid = %1$s';

// Execute Timezone FQL
$offset = 0;
$timezone = $facebook->api_client->fql_query(sprintf($fql, $user));

// Read Timezone
$offset = 0;
if (strcmp($timezone,'') != 0)
{ 
	if (strcmp($timezone[0][timezone],'') != 0)
	{ $offset = $timezone[0][timezone]; }
}

$birthdays_today = array();
$birthdays_tomorrow = array();
$birthdays_this_month = array();

$fql_current_month = date('F', gmmktime(gmdate('G') + $offset, 0, 0, date('m'), date('d'), date('Y')));
$fql_next_month = date('F', gmmktime(gmdate('G') + $offset, 0, 0, date('m') + 1, date('d'), date('Y')));

$current_month = date('n', gmmktime(gmdate('G') + $offset, 0, 0, date('m'), date('d'), date('Y')));
$current_day = date('n j', gmmktime(gmdate('G') + $offset, 0, 0, date('m'), date('d'), date('Y')));
$tomorrow_day = date('n j', gmmktime(gmdate('G') + $offset, 0, 0, date('m'), date('d') + 1, date('Y')));

// Format FQL
$fql = 'Select uid, birthday, name, pic_square from user where (strpos(birthday, "%1$s") == 0 or strpos(birthday, "%2$s") == 0) and uid in (Select uid2 from friend where uid1 = %3$s)';

echo "<!--" . sprintf($fql, $fql_current_month, $fql_next_month, $user) . "-->";

// Execute FQL
$birthdays_all = $facebook->api_client->fql_query(sprintf($fql, $fql_current_month, $fql_next_month, $user));

for ($intI = 0; $intI < sizeof($birthdays_all); $intI++)
{
	if (sizeof($birthdays_all[$intI]) == 4)
	{
		if (strcmp($birthdays_all[$intI]['birthday'], '') != 0)
		{
			$birthday_ts = strtotime($birthdays_all[$intI]['birthday']);

			$d = date('n j', $birthday_ts);
			$m = date('n', $birthday_ts);

			// Birthday in current month
			if ($m == $current_month)
			{ array_push($birthdays_this_month, $birthdays_all[$intI]); }
	
			// Birthday is today
			if (strcmp($d,$current_day) == 0)
			{ array_push($birthdays_today, $birthdays_all[$intI]); }

			// Birthday is tomorrow
			if (strcmp($d,$tomorrow_day) == 0)
			{ array_push($birthdays_tomorrow, $birthdays_all[$intI]); }
		}
	}
}

// Sort Today's Birthdays
if (strcmp($birthdays_today,'') != 0)
{ usort($birthdays_today, "cmp"); }

// Sort Tomorrow's Birthdays
if (strcmp($birthdays_tomorrow,'') != 0)
{ usort($birthdays_tomorrow, "cmp"); }

// Sort This Month's Birthdays
if (strcmp($birthdays_this_month,'') != 0)
{ usort($birthdays_this_month, "cmp"); }

echo "<!--";
echo "<p>Offset is " . $offset . "</p>";
echo "<p>Current Time is " . gmdate('G') . "</p>";
echo "<p>Today is " . $current_day . "</p>";
echo "<p>Tomorrow is " . $tomorrow_day . "</p>";
echo "<p>Month is " . $current_month . "</p>";
echo "<p>FQL Current is " . $fql_current_month . "</p>";
echo "<p>FQL Next is " . $fql_next_month . "</p>";
echo "-->";
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
		text-align: center; }
		
	.bUser a {
		display: block;
		width: 100px; }
		
	.info {
		background: #FFF9D7;
		border: solid 1px #E2C822;
		padding: 10px;
		margin: 0 0 10px 0; }
		
</style>

<div class="bWrapper">
	<div class="clearfix" style="padding-bottom: 10px;">
		<h1 style="float: left">Hi <fb:name firstnameonly="true" uid="<?=$user?>" useyou="false"/>!  Welcome to The Birthday Card Application	</h1>
		<div style="float: right"><a href="http://winthrop.facebook.com/apps/application.php?id=4671109309">More Information</a></div>
	</div>

	<fb:if-user-has-added-app>

		<div class="clearfix" style="border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; background: #EFEFEF; padding: 10px; position: relative;">
			<div>
				<p><strong>Step 1:</strong> Click Friend Below or Visit Friend's Profile Page</p>
				<p><strong>Step 2:</strong> Click Attach Birthday Card</p>
				<p><strong>Step 3:</strong> Choose Birthday Card</p>
				<p><strong>Step 4:</strong> Attach To Wall</p>
				<p><strong>Step 5:</strong> Have Great Success</p>
				<p><a href="http://winthrop.facebook.com/apps/application.php?id=4671109309">More Information</a></p>
			</div>
			<div style="text-align: center; width: 300px; position: absolute; right: 0; top: 10px;">
				<fb:iframe src="http://simplyearl.com/birthday/ads.php" scrolling=no frameborder=0 style="height: 210px; width: 210px;"></fb:iframe>
			</div>
		</div>
		
		<br />
		
		<div class="bGroup clearfix">
			<p class="info"><strong>I don't see my friend below, but I know it's their birthday!</strong><br><br>This application is affected by a user's privacy settings.  If you don't see your friend below it is likely they have changed their privacy settings to block applications from reading their profile information.  Don't fret my friend, you can still send them a birthday card via their wall or a message.  <a href="http://www.facebook.com/friends.php">View all your friends</a>.</strong></p>
		</div>
	
		<div class="bGroup clearfix" style="padding-top: 10px;">
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



