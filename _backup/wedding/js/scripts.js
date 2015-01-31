$(window).load(function() {
	// Load Twitter Status...
	$("div#twitter").load("/status/twitter.php");

	// Load Facebook Photos...
	$("div#facebook").load("/status/facebook.php");

	// Load Flickr Photos...
	$("div#flickr").load("/status/flickr.php");
});