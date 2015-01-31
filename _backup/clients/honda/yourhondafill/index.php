<?php
require_once '../fb/facebook.php';
$appapikey = 'd01fd94174ecb0eaddd1c80f1408aa4d';
$appsecret = 'f3d608570a6f007c1ca5f90d93c28bc7';
$facebook = new Facebook($appapikey, $appsecret);
$user_id = $facebook->require_login();

/* Variable Declaration */
$html 		= '';
$last_car	= '';
$first_car	= '';

$cars_and_mpg = array(
	'Accord'				=> array(
		'Sedan LX'			=> '18.5',
		'Sedan LX-P'		=> '18.5',
		'Sedan EX'			=> '18.5',
		'Sedan EX-L'		=> '18.5',
		'Sedan EX-L V-6'	=> '18.5',
		'Sedan EX V-6'		=> '18.5',
		'Coupe LX-S'		=> '18.5',
		'Coupe EX'			=> '18.5',
		'Coupe EX-L'		=> '18.5',
		'Coupe EX-L V-6'	=> '18.5'),
	'Civic'					=> array(
		'Sedan DX'			=> '13.2',
		'Sedan DX-VP'		=> '13.2',
		'Sedan LX'			=> '13.2',
		'Sedan EX'			=> '13.2',
		'Sedan EX-L'		=> '13.2',
		'Si Sedan'			=> '13.2',
		'Hybrid Sedan'		=> '12.3',
		'Coupe DX'			=> '13.2',
		'Coupe LX'			=> '13.2',
		'Coupe EX'			=> '13.2',
		'Coupe EX-L'		=> '13.2',
		'Si Coupe'			=> '13.2',
		'GX'				=> '8.0'),
	'CR-V'					=> array(
		'LX'				=> '15.3',
		'EX'				=> '15.3',
		'EX-L'				=> '15.3'),
	'Element'				=> array(
		'LX'				=> '15.9',
		'EX'				=> '15.9',
		'SC'				=> '15.9'),
	'Fit'					=> array(
		'Fit'				=> '10.6',
		'Fit Sport'			=> '10.6'),
	'Insight'				=> array(
		'Insight'				=> 	'10.6'),
	'Odyssey'				=> array(
		'LX'				=> '21',
		'EX'				=> '21',
		'EX-L'				=> '21',
		'Touring'			=> '21'),
	'Pilot'					=> array(
		'LX'				=> 	'21',
		'EX'				=> 	'21',
		'EX-L'				=> 	'21',
		'Touring'			=> 	'21'),
	'Ridgeline'				=> array(
		'RT'				=> 	'22',
		'RTS'				=> 	'22',
		'RTL'				=> 	'22'),
	'S2000'					=> array(
		'S2000'				=> 	'13.2',
		'S2000CR'			=> 	'13.2')
);

/* Prepare Your Honda Dropdown */
$html .= '<select id="yourhonda" onchange="Calculate()">';
$html .= '<option>Choose Your Honda</option>';
foreach ($cars_and_mpg as $car => $models) {
	foreach ($models as $model => $mpg) {
			$html .= $car != $last_car && $first_car != '' ? '</optgroup>' : '';
			$html .= $car != $last_car ? '<optgroup label="' . $car . '">' : '';
			$html .= '<option value="' . $mpg . '">' . $model . '</option>';
			$first_car = $car;
			$last_car = $car;
	}
}
$html .= '</optgroup>';
$html .= '</select>';

/* Prepare Location FQL */
$fql = 'Select current_location from user where uid = %1$s';

/* Execute Location FQL */
$location_array = $facebook->api_client->fql_query(sprintf($fql, $user_id));

?>

<link type="text/css" rel="stylesheet" href="http://honda.simplyearl.com/css/honda.css?v=1.22" /> 

<script type="text/javascript" language="javascript">
	function Calculate() {
		var ppg = document.getElementById('price').getValue();
		var mpg = document.getElementById('yourhonda').getValue();

		if (ppg == '')
			return Message('Please Enter Current Gas Price');
			
		if (isNaN(parseFloat(ppg)))
			return Message('Please Enter A Valid Current Gas Price');
			
		if (mpg == '' || isNaN(parseFloat(mpg)))
			return Message('Please Choose Your Honda');
			
		var cost = Math.round(ppg * mpg * 100)/100;
		document.getElementById('answer').setTextValue('$' + cost);
		document.getElementById('publish').setStyle('display', 'block');
		return Message(' ');
	}
	
	function Message(s) {
		document.getElementById('message').setTextValue(s);
		return;
	}
</script>

<form name="yourhondafill" fbtype="feedStory" action="http://honda.simplyearl.com/yourhondafill/handler.php">
<div id="honda_wrapper">
	<div id="honda_header"><h1>Did You Know Your Honda Will Only Cost This Much To Fill Up?</div>
    <div id="honda_body" class="honda_fill">

		<div id="message" class="alert"></div>
		<p>Current Local Gas Price: $<input type="text" id="price" size="6" />&nbsp;&nbsp;<a href="http://autos.msn.com/everyday/gasstationsbeta.aspx" target="_blank">Find Local Prices</a></p>
		<p>Choose Your Honda: <?php echo $html ?>&nbsp;&nbsp;<input type="button" value="Calculate" onclick="Calculate()" /></p>
		<div id="answer_wrapper">
			<p id="title">Per Fill Up</p>
			<p id="answer">&nbsp;</p>
			<div id="publish"><input type="submit" label="Publish Your Results" /></div>
		</div>
		<div id="honda_know"></div>
	</div>
    <div id="honda_footer"></div>
</div>
</form>
