<?php
require_once 'config.php';

require_once '../fb/facebook.php';
$appapikey = '7b2f176915614f3ef4f6863f4cf5d42e';
$appsecret = '8529d7b68cd92fbb3a5fce77dd53fc01';
$facebook = new Facebook($appapikey, $appsecret);
$user_id = $facebook->require_login();

/* Variable Declaration */
$html				= '';
$status				= '';
$winner				= '';
$mark				= '';
$tally				= 0;
$question_counter	= 0;
$form_submitted		= isset($_POST['submit']);

/* Build Form */
$html .= '<form method="post">';
$html .= '<ol>';
foreach ($questions_and_answers as $question => $answers) {
		
	/* Update Tally */
	if (array_key_exists($_POST['q' . $question_counter],$answers))
		$cars_and_responses[$_POST['q' . $question_counter]]['tally']++;

	/* Didn't Answer All Questions */
	if ($form_submitted && !isset($_POST['q' . $question_counter]))
		$status = '<p class="alert">Please answer all the questions.</p>';

	$html .= '<li>';
	$html .= $question;
	$html .= $form_submitted && !isset($_POST['q' . $question_counter]) ? '<span class="required"> * Required</span>' : '';
	$html .= '<ul>';
	foreach ($answers as $car => $answer) {
		$checked = isset($_POST['q' . $question_counter]) && $_POST['q' . $question_counter] == $car ? ' checked ' : '';
		$html .= '<li>';
		$html .= '<label>';
		$html .= '<input type="radio" name="q' . $question_counter . '" value="' . $car . '"' . $checked . '>';
		$html .= $answer;
		$html .= '</label>';
		$html .= '</li>';
	}
	$html .= '</ul>';
	$html .= '</li>';
	$question_counter++;
}
$html .= '</ol>';
$html .= '<input type="submit" name="submit" value="Submit" />';
$html .= '</form>';

/* Combine Status & HTML */
$html = $status . $html;

/* Find Winner */
if ($form_submitted && $status == '') {

	/* Generate Tally */
	foreach ($cars_and_responses as $car => $responses) {
		if ($responses['tally'] > $tally) {
			$tally = $responses['tally'];
			$winner = $car;
		}
	}

	/* Display Winner */
	$html = '';
	$html .= '<h1>You Are... A Honda ' . $winner . '</h1>';
	$html .= '<h2>' . $cars_and_responses[$winner]['response'] . '</h2>';
	$html .= '<h2><strong>Did You Know?</strong>  ' . $cars_and_responses[$winner]['know'] . '</h2>';
	$html .= '<p id="car"><img src="' .  $cars_and_responses[$winner]['img'] . '" alt=""/></p>';
	$html .= '<p></p>';
	$html .= '<form name="yourhondapersona" fbtype="feedStory" action="http://honda.simplyearl.com/yourhondapersona/handler.php">';
	$html .= '<input type="hidden" name="car" value="' . $winner . '" />';
	$html .= '<input type="submit" label="Publish Your Results" />';
	$html .= '<p><a href="./">Retake Quiz</a></p>';
	$html .= '</form>';
}
?>

<link type="text/css" rel="stylesheet" href="http://honda.simplyearl.com/css/honda.css" /> 

<div id="honda_wrapper">
	<div id="honda_header"><h1>Did You Know Your Honda Persona?</div>
    <div id="honda_body">
		<?php echo $html ?>
		<div id="honda_know"></div>
	</div>
    <div id="honda_footer"></div>
</div>
