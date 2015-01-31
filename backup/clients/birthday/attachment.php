<?php 

include_once 'config.php';
include_once 'lib.php';

// Variable Declaration
$strDisplay = 'false';
$strURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

$strTemplate = ''
. "\n" . '<script language="javascript" type="text/javascript">'
. "\n" . '<!--'
. "\n" . ''
. "\n" . '	function fSet(id)'
. "\n" . '	{ document.getElementById(id).setChecked(true); }'
. "\n" . '	'
. "\n" . '	function fUpdateContent(strCategory)'
. "\n" . '	{'
. "\n" . '		var ajax = new Ajax();'
. "\n" . '		ajax.responseType = Ajax.FBML;'
. "\n" . '		ajax.ondone = function(data) {'
. "\n" . '			document.getElementById("content-wrapper").setInnerFBML(data);'
. "\n" . '		}'
. "\n" . ''
. "\n" . '		ajax.requireLogin =1;'
. "\n" . '		ajax.post("http://simplyearl.com/birthday/attachment_c.php?c=" + strCategory);'
. "\n" . '	}'
. "\n" . ''
. "\n" . '	function fResetFlash(strID)'
. "\n" . '	{'
. "\n" . '		document.getElementById("flash_" + strID).setTextValue("");'
. "\n" . '		var ajax = new Ajax();'
. "\n" . '		ajax.responseType = Ajax.FBML;'
. "\n" . '		ajax.ondone = function(data) {'
. "\n" . '			document.getElementById("flash_" + strID).setInnerFBML(data);'
. "\n" . '		}'
. "\n" . ''
. "\n" . '		ajax.requireLogin = 1;'
. "\n" . '		ajax.post("http://simplyearl.com/birthday/get_swf.php?t=" + strID);'
. "\n" . '	}'
. "\n" . ''
. "\n" . '//-->'
. "\n" . '</script>'
. "\n" . ''
. "\n" . '<form id="content_form"></form>'
. "\n" . '<div id="wrapper">'
. "\n" . ''
. "\n" . '	<h1>Choose A Birthday Card</h1>'
. "\n" . '	<div id="content-wrapper">'
. "\n" . '		%1$s'
. "\n" . '	</div>'
. "\n" . '</div>'
. "\n" . '<!-- #wrapper -->'
. "\n" . ''
. "\n" . '<!-- Return URL -->'
. "\n" . '<input type="hidden" name="url" value="%2$s" />'
. "\n" . ''
. "\n" . '<!-- Google Analytics Frame -->'
. "\n" . '<fb:iframe src="http://simplyearl.com/birthday/analytics.php?t=FB:Birthday_Attachment" frameborder=0 style="height: 1px; width: 1px;"></fb:iframe>';


// Display Template
if (!isset($_POST['message_sent']) || $_POST['message_sent'] < 1)
{ 
	// Format Return
	$strReturn = sprintf($strTemplate,
		get_include_contents('attachment_c.php'),
		$strURL);
}

// Display Specific Image
else
{ 
	if (isset($_POST['t']))
	{
		fRecordUser();
		fRecordAttachment();
		if (substr($_POST['t'],strlen($_POST['t']) - 3) == 'swf')
		{ $strReturn = sprintf($GLOBALS['strFlash'], $_POST['t']); }
		else
		{ $strReturn = sprintf($GLOBALS['strImage'], $_POST['t'], 'width="320"'); }
	}
	else
	{ $strReturn = 'Please Select A Birthday Card'; }
}

echo $strReturn;
?>
