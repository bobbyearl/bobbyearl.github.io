<?php 

include_once 'config.php';
include_once 'lib.php';

// Variable Declaration
$intMax = 0;
$intRelativeMax = 0;
$intPrev = 0;
$intNext = 0;
$intJ = 0;

$strTemp = '';
$strReturn = '';
$strPrev = '';
$strNext = '';
$strCurrent = '';
$strDisplay = '';
$strCategory = '';
$strChecked = 'checked';

$strCategories = ''
. "\n" . '<div >'
. "\n" . '<ul class="clearfix" style="list-style: none; margin: 0; padding: 0;">'
. "\n" . '	<li style="float: left; list-style: none; padding: 10px; text-align: center; width: %1$spx;">'
. "\n" . '		<a class="clickable" clicktoshow="loading" clicktohide="content" onclick="fUpdateContent(\'funny\')">'
. "\n" . '			%2$s'
. "\n" . '		</a>'
. "\n" . '	</li>'
. "\n" . '	<li style="float: left; list-style: none; padding: 10px; text-align: center; width: %1$spx;">'
. "\n" . '		<a class="clickable" clicktoshow="loading" clicktohide="content" onclick="fUpdateContent(\'flash\')">'
. "\n" . '			%3$s'
. "\n" . '		</a>'
. "\n" . '	</li>'
. "\n" . '	<li style="float: left; list-style: none; padding: 10px; text-align: center; width: %1$spx;">'
. "\n" . '		<a class="clickable" clicktoshow="loading" clicktohide="content" onclick="fUpdateContent(\'clipart\')">'
. "\n" . '			%4$s'
. "\n" . '		</a>'
. "\n" . '	</li>'
. "\n" . '	<li style="float: left; list-style: none; padding: 10px; text-align: center; width: %1$spx;">'
. "\n" . '		<a class="clickable" clicktoshow="loading" clicktohide="content" onclick="fUpdateContent(\'sincere\')">'
. "\n" . '			%5$s'
. "\n" . '		</a>'
. "\n" . '	</li>'
. "\n" . '	<li style="float: left; list-style: none; padding: 10px; text-align: center; width: %1$spx;">'
. "\n" . '		<a class="clickable" clicktoshow="loading" clicktohide="content" onclick="fUpdateContent(\'pets\')">'
. "\n" . '			%6$s'
. "\n" . '		</a>'
. "\n" . '	</li>'
. "\n" . '</ul>'
. "\n" . '</div>';

$strRow = ''
. "\n" . '<tr id="c%1$s" style="display: %5$s;">'
. "\n" . '	<td style="text-align: center">'
. "\n" . '		<table cellspacing="0" cellpadding="5" width="100&#37;">'
. "\n" . '			<tr>'
. "\n" . '				<td width="100" style="border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; background: #EFEFEF;">'
. "\n" . '					<input type="submit" clicktohide="c%1$s" clicktoshow="c%2$s" %6$s onclick="fSet(\'t%2$s\'); %13$s" value="Previous" />'
. "\n" . '				</td>'
. "\n" . '				<td width="100&#37;" style="border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; background: #EFEFEF; text-align: center">'
. "\n" . '					%9$s of %10$s'
. "\n" . '				</td>'
. "\n" . '				<td width="100" align="right" style="border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; background: #EFEFEF; text-align: right">'
. "\n" . '					<input type="submit" clicktohide="c%1$s" clicktoshow="c%3$s" %7$s onclick="fSet(\'t%3$s\'); %13$s" value="Next" />'
. "\n" . '				</td>'
. "\n" . '			</tr>'
. "\n" . '			<tr>'
. "\n" . '				<td colspan="3" style="text-align: center">'
. "\n" . '					<div id="flash_%12$s">%4$s</div>'
. "\n" . '					<span style="display: none"><input type="radio" id="t%1$s" name="t" value="%11$s" %8$s /></span>'
. "\n" . '				</td>'
. "\n" . '			</tr>'
. "\n" . '			<tr>'
. "\n" . '				<td colspan="3">'
. "\n" . '					<a href="http://winthrop.facebook.com/apps/application.php?id=4671109309" target="_blank">Report Bugs</a><br />'
. "\n" . '					<a href="http://winthrop.facebook.com/apps/application.php?id=4671109309" target="_blank">Suggest Birthday Card</a>'
. "\n" . '				</td>'
. "\n" . '			</tr>'
. "\n" . '		</table>'
. "\n" . '	</td>'
. "\n" . '</tr>';

$strTable = ''
. "\n" . '		<div id="loading" style="display: none; text-align: center">'
. "\n" . '			<img src="http://static.ak.facebook.com/images/upload_progress.gif" alt="Loading..." />'
. "\n" . '		</div>'
. "\n" . '		<div id="content">'
. "\n" . '			%1$s'
. "\n" . '			<table border="0" cellspacing="0" cellpadding="0" width="100&#37;">'
. "\n" . '			%2$s'
. "\n" . '			</table>'
. "\n" . '		</div>';

// Grab Category From Query String
$strCategory = $_GET['c'];

// Number of Cards
$intMax = sizeof($GLOBALS[arrCards]);
$intRelativeMax = $intMax;

// Loop through all cards
for ($intI = 0; $intI <= $intMax; $intI++)
{	
	// Do the categories match?
	if ($strCategory == $GLOBALS['arrCards'][$intI][0])
	{ $intJ++; }
}

// Update Relative Maximum
$intRelativeMax = $intJ;

// Reset counters	
$intI = 0;
$intJ = 0;

// Loop through all cards
for ($intI = 0; $intI < $intMax; $intI++)
{
	// Do the categories match?
	if ($strCategory == $GLOBALS['arrCards'][$intI][0])
	{
		$intPrev = sprintf('%02d', $intJ - 1);
		$intNext = sprintf('%02d', $intJ + 1);
		$intCurrent = sprintf('%02d', $intJ);
		
		$strPrev = $intJ == 0 ? 'disabled' : '';
		$strNext = $intJ == ($intRelativeMax - 1) ? 'disabled' : '';
		
		// Flash Or Image?
		if (substr($GLOBALS['arrCards'][$intI][1],strlen($GLOBALS['arrCards'][$intI][1]) - 3) == 'swf')
		{ 
			$strCurrentImage = sprintf($GLOBALS['strFlash'], $GLOBALS['arrCards'][$intI][1]);
			$strTemp = 'fResetFlash(\'' . sprintf('%02d', $intI) . '\');';
		}
		else
		{ $strCurrentImage = sprintf($GLOBALS['strImage'], $GLOBALS['arrCards'][$intI][1], 'width="320"'); }
			
		$strReturn .= sprintf($strRow, 
			$intCurrent, 
			$intPrev, 
			$intNext, 
			$strCurrentImage, 
			$strDisplay, 
			$strPrev, 
			$strNext, 
			$strChecked, 
			($intJ + 1), 
			$intRelativeMax,
			$GLOBALS['arrCards'][$intI][1],
			$intI,
			$strTemp
		);

		$strDisplay = 'none';
		$strChecked = '';
		$strTemp = '';
		$intJ++;
	}
}

// Display Small Navigation
if (isset($_GET['c']))
{
	$strNav = sprintf($strCategories,
		'40',
		'Funny',
		'Animated',
		'Clip Art',
		'Sincere',
		'Pets');			
}
	
// Display Large Navigation
else
{
	$strNav = sprintf($strCategories,
		'100',
		'<img src="http://earlr.people.cofc.edu/birthday/img/t_funny.jpg" alt="Funny" /><br />Funny',
		'<img src="http://earlr.people.cofc.edu/birthday/img/t_flash.jpg" alt="Animated" /><br />Animated',
		'<img src="http://earlr.people.cofc.edu/birthday/img/t_clipart.jpg" alt="Clip Art" /><br />Clip Art',
		'<img src="http://earlr.people.cofc.edu/birthday/img/t_sincere.jpg" alt="Sincere" /><br />Sincere',
		'<img src="http://earlr.people.cofc.edu/birthday/img/t_pets.jpg" alt="Pets" /><br />Pets');
}

$strReturn = sprintf($strTable, $strNav, $strReturn);

echo $strReturn; 

?>

