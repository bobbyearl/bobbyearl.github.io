<?
/* PHP Control Logic for Template
        - First access passed querystring for content.
        - If content is empty, we're looking for the index - display full banner
        - Add extension to content
        - Verify file exists
*/
    // COMMENT: Specified Content
	$strQuery = strtolower($_SERVER['REQUEST_URI']);
	
	// COMMENT: Remove Horse From Querystring
	if (substr_count($strQuery,"horse") != 0)
		$strQuery = str_replace("horse","",$strQuery);

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
		$strFile = '../err/404.htm';
?>




<!DOCTYPE html PUBLIC
"-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<!-- COMMENT: Title Begin -->
<title>Equine Intervention, LLC  <? echo ucfirst($strSection) ?></title>
<!-- COMMENT: Title End -->

<!-- COMMENT: Meta Data Begin -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- COMMENT: Meta Data End -->

<!-- COMMENT: Style Begin -->
<link rel="stylesheet" type="text/css" media="screen" href="css/screen-orig.css"/>
<link rel="stylesheet" type="text/css" media="print" href="css/print.css"/>
<!-- COMMENT: Style End -->

</head>
<body>
<form method="post" action="">

<!-- COMMENT: NoScript Begin-->
<noscript>
This site utilizies javascript: without it, the site <b>may not</b> function properly.
</noscript>
<!-- COMMENT: NoScript End -->

<!-- COMMENT: Accessibility Begin-->
<div id="accessibility">
<a href="#content">Skip To Content</a> |
<a href="#nav">Skip To Navigation</a>
</div>
<!-- COMMENT: Accessibility End -->

<!-- COMMENT: Logo Begin -->
<div id="logo">
	<h1><a href="./">Equine Intervention</a></h1>
	<p id="horse"><span>H</span>elping <span>O</span>thers <span>R</span>ecognize <span>S</span>olutions <span>E</span>xperientially</p>
</div>
<!-- COMMENT: Logo End -->

<!-- COMMENT: Div Wrapper Begin -->
<div id="wrapper">

	<!-- COMMENT: Sidebar Begin -->
	<div id="sidebar">
	
		<!-- COMMENT: Navigation Begin -->
		<a name="nav"></a>
		<ul id="nav">
			<li><a href="about.htm" title="About Equine Intervention">About Equine Intervention</a></li>
			<li><a href="events.htm" title="Upcoming Events">Upcoming Events</a></li>
			<li><a href="eap.htm">Equine Assisted Psychotherapy</a></li>
			<li><a href="eal.htm">Equine Assisted Learning</a></li>
			<!--<li><a href="#">Team Building</a></li>-->
			<li><a href="http://eagala.org" target="_blank">EAGALA</a></li>
			<li><a href="contact.htm" title="Contact Equine Intervention">Contact Equine Intervention</a></li>
		</ul>
		<!-- COMMENT: Subnav End -->
		
	</div>
	<!-- COMMENT: Sidebar End -->

	<!-- COMMENT: Content Wrapper Begin -->
	<a name="content"></a>
	<div id="content-wrapper">
	<div id="content-wrapper-inner">
	
		<? include($strFile); ?>
		
		<!-- COMMENT: Mission Begin -->
		<!--
		<div id="mission">
			<h3>Equine Intervention Mission</h3>
			<p>The mission of Equine Intervention, LLC is to provide all clients 
			the best experience in equine assisted psychotherapy and equine 
			assisted learning available. This service shall not be restricted to 
			the client’s ability to pay for services. It is our duty to protect 
			the privacy and emotional safety of all clients at all times. We 
			will adhere to all ethical protocol of the EAGALA model and mental 
			health standards. The Equine Intervention facilitating team will 
			always act in the best interest of the client without compromising 
			the safety of our horses or our treatment team. </p>
		</div>
		-->
		<!-- COMMENT: Mission End -->

	</div>
	</div>
	<!-- COMMENT: Content Wrapper End -->

	<!-- COMMENT: Footer Begin -->
	<div id="footer">

		<!-- COMMENT: Contact Begin -->
		<div id="footercontact">
			Equine Intervention, LLC<br />Hartsville, SC  (843) 453-9985<br />
			<a href="mailto:horsedoctor@bellsouth.net">horsedoctor@bellsouth.net</a>
		</div>
		<!-- COMMENT: Contact End -->

		<!-- COMMENT: Copyright Begin -->
		<!--
		<div id="footercopy">
			<ul>
				<li><a href="http://validator.w3.org/check/referer" title="Validate XHTML" target="_blank">
				xhtml</a></li>
				<li><a href="http://jigsaw.w3.org/css-validator/check/referer" title="Validate CSS" target="_blank">
				css</a></li>
				<li><a href="http://www.contentquality.com/mynewtester/cynthia.exe?Url1=http://equineintervention.com" title="Validate 508 Guidelines" target="_blank">
				508</a></li>
			</ul>
		</div>
		-->
		<!-- COMMENT: Copyright End -->
	
		<!-- COMMENT: HR required to break float -->

		<hr />
		<!-- COMMENT: HR required to break float -->
	
	</div>
	<!-- COMMENT: Footer End -->

</div>
<!-- COMMENT: Div Wrapper End -->

</form>
</body>
</html>