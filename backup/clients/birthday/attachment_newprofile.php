<?php 

/* Includes */
include_once 'client/facebook.php';
include_once 'config.php';
include_once 'lib.php';
$facebook = new Facebook($api_key, $secret);
//$facebook->require_frame();


/* Variable Declarations */
$strDisplay = '';
$strURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
$strURL = 'http://simplyearl.com/birthday/';
$strSCRIPT = 'attachment_c_newprofile.php';
$strJSON = '{"content": {"fbml":%1$s, "publishEnabled":false, "commentEnabled":false }, "method":"%2$s" }';

$strContent = <<<END

	<script>
	function fSet(id){  
		document.getElementById(id).setChecked(true); 
	}
	
	function fUpdateContent(strC) {
		var ajax = new Ajax();
		ajax.responseType = Ajax.FBML;
		ajax.ondone = function(data) {
			document.getElementById('dynamic').setInnerFBML(data);
			Facebook.setPublishStatus(true);
		}

		ajax.requireLogin = 1;
		var params = {'c':strC};
		ajax.post("$strURL$strSCRIPT",params);
	}

	function do_hello() {
		var dialog= new Dialog().showMessage('Dialog', 'Hello World.');
	}
	</script>

END;

$strResponse = "NO_METHOD?";
echo $_POST['method'];

if ($_POST['method'] == 'publisher_getFeedStory'):
        $templateid = '35834998919';
        $tokens = array("url"=>"<a href='http://apps.facebook.com/birthdaybudy/'>Birthday Card</a>","card"=>"");
	$strResponse = sprintf($strJSON, json_encode('huh'), 'publisher_getFeedStory');
	$target_ids = array();
	$facebook->api_client->feed_publishUserAction( $templateid, json_encode($tokens) , implode(',', $target_ids), $body_general);
	
else:
	$strResponse = sprintf($strJSON, json_encode($strContent . get_include_contents($strSCRIPT)), 'publisher_getInterface');
	echo $strResponse;
endif;
?>
