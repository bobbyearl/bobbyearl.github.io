<?php

// Set timezone
date_default_timezone_set('America/New_York');

// Store some important dates
$current = new DateTime('now');
$married = new DateTime('2007-11-17');
$reeves = new DateTime('2009-02-08');
$william = new DateTime('2010-12-16');

?>

<!DOCTYPE html>
<html lang="en">
<head>

<title>Bobby Earl</title>
<link rel="shortcut icon" href="img/favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="bootstrap-3.0.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/screen.css">

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-460794-1']);
  _gaq.push(['_setDomainName', 'bobbyearl.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script id="template" type="text/x-handlebars-template">
<div class="row portfolio">
	<div class="col-md-12">
		<h2>Portfolio</h2>
		<div class="row">
			{{#each portfolio}}
				<div class="col-md-3">
					<a 
						href="{{thumbnail}}" 
						class="thumbnail" 
						rel="popover" 
						target="_blank"
						data-title="{{title}}" 
						data-content="
							{{#if description}}
								{{description}}
							{{/if}}
							{{#if tech}}
								<ul class='list-unstyled'>
									{{#each tech}}
										<li>{{this}}</li>
									{{/each}}
								</ul>
							{{/if}}
					">
						<img src="{{thumbnail}}" alt="{{title}}" />
					</a>
				</div>
			{{/each}}
		</div>
	</div>
</div>

<?php
if (isset($_GET['unity'])):

	$unity = array(
	    'Art Gallery' => array(
	    	'key' => 'ArtGallery',
	    	'tech' => '2D'
	    ),
	    'Bike Paths' => array(
	    	'key' => 'BikePaths',
	    	'tech' => '3D'
	    ),
	    'Bubble Machine' => array(
	    	'key' => 'BubbleMachine',
	    	'tech' => '3D'
	    ),
	    'Iguana' => array(
	    	'key' => 'Iguana',
	    	'tech' => '3D'
	    ),
	    'Recreation Center' => array(
	    	'key' => 'RecreationCenter',
	    	'tech' => '2D, Video'
	    ),
	    'School Corridor' => array(
	    	'key' => 'SchoolCorridor',
	    	'tech' => '3D'
	    ),
	    'Smoothie Shop' => array(
	    	'key' => 'SmoothieShop',
	    	'tech' => ''
	    )
	);

	// Unity3d Samples (only if requested)
	echo '<div class="info">';
	echo '	<div class="row">';
	echo '		<div class="col-md-12">';
	echo '			<h2>Unity3D</h2>';
	echo '		</div>';
	echo '	</div>';
	echo '	<div class="row">';
	echo '		<div class="col-md-3">';
	echo '			<p>These samples were designed as "mini-games" to test 8th graders for the Department of Education.  Most of the interface is done in 2D using GUI because of client requests.  Art Gallery and Iguana utilizie the 3D capabilities.</p>';
	echo '		</div>';
	echo '		<div class="col-md-9">';
	echo '			<div class="row">';

	foreach ($unity as $key=>$a) {
        echo '<div class="col-md-3 unity-item"><a class="" href="unity/player.php?p=' . $a['key'] . '" target="_blank">' . $key . '</a></div>';
	}

	echo '			</div>';
	echo '		</div>';
	echo '	</div>';
	echo '</div>';

endif;
?>

</script>

</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<h1>Bobby Earl</h1>

			<div class="info">
				<div class="row">
					<div class="col-md-4">
						<h2>Welcome</h2>
						<p>I'm a developer from Charleston, SC.  Currently I'm a Senior Interactive Developer with <a href="http://www.guidecreative.com" target="_blank">Guide Creative</a> / <a href="http://www.blackbaud.com" target="_blank">Blackbaud</a>.</p>
						<p>Lately, I've enjoyed using <a href="http://twitter.github.com/bootstrap/" target="_blank">Bootstrap</a>, <a href="http://handlebarsjs.com/" target="_blank">Handlebars</a> and <a href="http://jquery.com/" target="_blank">jQuery</a> while being able to <strong><a href="https://github.com/simplyearl?tab=activity" target="_blank">contribute</a></strong> back to the open source community.</p>
					</div>
					<div class="col-md-4">
						<h2>Passion</h2>
						<p>I enjoy problem solving and technical challenges.  Transitioning from LEGO military vehicles as a child to obtaining a BS in Computer Science from <a href="http://www.winthrop.edu" target="_blank">Winthrop University</a> seemed like a natural progression for me.</p>
						<p>Check out some recent works below or <a href="#" rel="tooltip" title="Coming Soon">view my résumé</a>.</p>
					</div>
					<div class="col-md-4">
						<h2>Inspiration</h2>
						<p>Being a husband to my <a href="http://ashley.simplyearl.com" target="_blank">beautiful wife Ashley</a> for <?php echo $current->diff($married)->format('%y'); ?> years and a father to our two young boys, <?php echo $current->diff($reeves)->format('%y'); ?> and <?php echo $current->diff($william)->format('%y'); ?>, has been the most rewarding and challenging experience of my entire life, but I would not be who I am today without them.</p>
					</div>
				</div>
			</div>

			<div id="portfolio"><img src="img/loading.gif" alt="Loading..." /></div>

			<hr />

			<div class="row">
				<div class="col-md-6">
					<ul class="list-unstyled muted contact">
						<li><a href="mailto:bobby@simplyearl.com" target="_blank">bobby@simplyearl.com</a></li>
						<li>Last Modified: <span class="formatDT"><?php echo getlastmod(); ?></span></li>
					</ul>
				</div>
				<div class="col-md-6">
					<ul class="list-inline social pull-right">
						<li><a href="http://www.facebook.com/bobbyearl/" target="_blank" title="Facebook"><img src="img/facebook.png" alt="Facebook" /></a></li>
						<li><a href="http://foursquare.com/simplyearl" target="_blank" title="FourSquare"><img src="img/foursquare.png" alt="FourSquare" /></a></li>
						<li><a href="http://www.linkedin.com/in/bobbyearl" target="_blank" title="LinkedIn"><img src="img/linkedin.png" alt="LinkedIn" /></a></li>
						<li><a href="http://www.twitter.com/simplyearl" target="_blank" title="Twitter"><img src="img/twitter.png" alt="Twitter" /></a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="bg"></div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/handlebars.js"></script>
<script type="text/javascript" src="bootstrap-3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bobbyearl.js"></script>

</body>
</html>
