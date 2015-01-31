<input type="hidden" name="url" value="http://simplyearl.com/birthday/fetch.php" />
<fb:iframe src="http://simplyearl.com/birthday/analytics.php?t=FB:Birthday_Attachment" frameborder=0 style="height: 1px; width: 1px;"></fb:iframe>

<?php 

$cardList = <<<EndHereDoc

<h1>Choose Birthday Card</h1>
<table border="0" cellspacing="0" cellpadding="5" width="100%">
	<tr>
		<td width="50%" align="center"><label for="t01"><img src="http://simplyearl.com/birthday/img/t01.jpg" alt="Background 01" /></label><br /><input type="radio" id="t01" name="t" value="01" /></td>
		<td width="50%" align="center"><label for="t02"><img src="http://simplyearl.com/birthday/img/t02.jpg" alt="Background 02" /></label><br /><input type="radio" id="t02" name="t" value="02" /></td>
	</tr>
</table>

<p><a href="http://simplyearl.com/birthday/suggest.php" target="_blank">Suggest New Birthday Card Design</a></p>

EndHereDoc;

if ($_POST['message_sent'] < 1)
{ echo $cardList; }
else
{

	echo '<img src="http://simplyearl.com/birthday/img/f' . $_POST['t'] . '.jpg" alt="" width="318" />';
	//echo $_POST['m'];
	
	//foreach($_POST as $variable => $value)
	//{ echo $variable . ' = ' . $value . '<br />'; }

	//echo "<hr />";

	//foreach($_GET as $variable => $value)
	//{ echo $variable . ' = ' . $value . '<br />'; }
}

?>

