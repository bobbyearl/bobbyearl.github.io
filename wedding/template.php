<?
/* PHP Control Logic for Template
        - First access passed querystring for content.
        - If content is empty, we're looking for the index - display full banner
        - Add extension to content
        - Verify file exists
*/
        // COMMENT: Specified Content
	$strQuery = strtolower($_SERVER['REQUEST_URI']);

	// COMMENT: Remove Redesign From Querystring
	if (substr_count($strQuery,"redesign") != 0)
		$strQuery = str_replace("redesign","",$strQuery);
		
	// COMMENT: Remove Wedding From Querystring
	if (substr_count($strQuery,"wedding") != 0)
		$strQuery = str_replace("wedding","",$strQuery);

	// COMMENT: Remove Trailing Slash
	if (substr($strQuery, -1) == "/")
		$strQuery = substr($strQuery, 0, strlen($strQuery) - 1);

	// COMMENT: Remove Leading Slash
	if (substr($strQuery, 0, 1) == "/")
		$strQuery = substr($strQuery, 1, strlen($strQuery));

        // COMMENT: Split Into Section And File
        list($strSection,$strFile) = split("/", $strQuery);

        // COMMENT: Use Index For File If Not Specified
        // COMMENT: Check for home when accessing main site without trailing slash
        if (!$strFile || strcmp($strFile,"home") == 0)
                $strFile = "index";

        // COMMENT: Add Section To File
        if ($strSection)
                $strFile = $strSection . "/" . $strFile;

        // COMMENT: Add Extension
        if (substr_count($strFile,".") == 0)
                $strFile .= ".htm";

        // COMMENT: Verfiy File Exists
        if (!file_exists($strFile))
		$strFile = 'err/404.htm';
?>

<!DOCTYPE html PUBLIC
"-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<!-- COMMENT: Title Begin -->
<title>Simply Earl <? echo ucfirst($strSection) ?></title>
<!-- COMMENT: Title End -->

<!-- COMMENT: Base Begin -->
<base href="http://simplyearl.com/wedding/" />
<!-- COMMENT: Base End -->

<!-- COMMENT: Meta Data Begin -->
<meta name="verify-v1" content="LIXBNoYPzDeTGEQI9p6x/LRF63REt4sAIcJjR1P+Kj0=" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- COMMENT: Meta Data End -->

<!-- COMMENT: Style Begin -->
<link rel="stylesheet" type="text/css" media="screen" href="css/screen.css"/>
<!-- COMMENT: Style End -->

<!-- COMMENT: Javascript Begin -->
<!-- COMMENT: Javascript End -->

<!-- COMMENT: Icon Begin -->
<link rel="Shortcut Icon" type="image/x-icon" href="img/favicon.ico" />
<!-- COMMENT: Icon End -->

</head>
<body>

<div id="wrapper">

	<div id="nav">
		<ul>
			<li><a href="http://simplyearl.com">Home</a></li>
			<li><a href="http://simplyearl.com/wedding/">Wedding</a></li>
			<li><a href="http://www.flickr.com/photos/bobbyearl/" target="_blank">Memories</a></li>
			<li><a href="http://simplyearl.com/wedding/contact/">Contact</a></li>
		</ul>	
	</div> <!-- #nav -->
	
	<div id="content-wrapper" class="clearfix">
	
		<p class="c"><img src="img/header.jpg" alt="Ashley Carr and Bobby Earl - November 17, 2007" /></p>
		
		<div id="content" class="clearfix">	
			<? include($strFile); ?>
		</div> <!-- #content -->
		
	</div> <!-- #content-wrappper -->

</div> <!-- #wrapper -->

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-460794-6";
urchinTracker();
</script>

</body>
</html>
