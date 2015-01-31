<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php if (isset($_GET['p']) && strpos($_GET['p'], '..') !== true) : ?>
<head>
	<script type="text/javascript" src="js/UnityObject.js"></script>
	<script src="js/PlatformToUnityCustom.js"></script>
	<script type="text/javascript">
		<!--
		var autostart = true;
		if (typeof unityObject != "undefined") {
			unityObject.embedUnity("unityPlayer", "<?php echo $_GET['p'] . '/' . $_GET['p']; ?>.unity3d", 1186, 714, null, null, unityLoaded);

		}
		function unityLoaded(result) {
			if (!result.success) {
				alert("Please install Unity Web Player!");
			}
		}
		-->
	</script>
</head>
<body>
	<div id="unityPlayer"></div>
	<div id="buttons" style="display: none">
		<input type="button" value="InitSetReq(ENG/Blue)"onclick="InitializeSetting_Request_ENG_BLUE(100);" />
		<input type="button" value="InitSetReq(SPA/Blue)" onclick="InitializeSetting_Request_SPA_BLUE(100);" />
		<input type="button" value="TTS" onclick="TextForTTS_Request(200);" />
		<input type="button" value="StateInfo" onclick="ItemStateInfo_Request(300);" />
		<input type="button" value="Lang ENG" onclick="ChangeLanguage_Request(400 + ',' + 'ENG');" />
		<input type="button" value="Lang SPA" onclick="ChangeLanguage_Request(400 + ',' + 'SPA');" />
		<input type="button" value="Skin Blue" onclick="ChangeSkin_Request(500 + ',' + 'blue');" />
		<input type="button" value="Skin Silver" onclick="ChangeSkin_Request(500 + ',' + 'silver');" />
		<input type="button" value="Skin Contrast" onclick="ChangeSkin_Request(500 + ',' + 'contrast');" />
		<input type="button" value="Pause" onclick="PauseItem_Request(600);" />
		<input type="button" value="Resume" onclick="ResumeItem_Request(700);" />
		<!--<input type="button" value="Highlight" onclick="HighlightText_Request(800);" />-->
		<input type="button" value="ClearLogInfo" onclick="document.getElementById('log').innerHTML = document.getElementById('error').innerHTML = '';" />
		<textarea id="state" rows="4" cols="140"></textarea><br />
		<input type="button" value="ClearStateInfo" onclick="document.getElementById('state').value = ''"/>
	</div>
	<div id="log" style="display: none"></div>
	<div id="error" style="color: red; display: none"></div>
</body>

<?php else: ?>

<body>
<p>A valid project is required!</p>
</body>

<?php endif; ?>

</html>
