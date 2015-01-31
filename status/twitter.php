<?php

require_once("cache.php");
require_once("twitter/gagawa-1.0.php");
require_once("twitter/JSON.php");
require_once("twitter/datehelper.php");
require_once("twitter/oauth-php/library/OAuthStore.php");
require_once("twitter/oauth-php/library/OAuthRequester.php");

define("TWITTER_CONSUMER_KEY", "BZ0hpuaecz0SKMhQnHUy1g");
define("TWITTER_CONSUMER_SECRET", "sLS4wMEBBn7CxcnnEpgQlJXc8w7i7aXOGZ2CzSVv8lE");
define("REFRESH_INTERVAL", 1800);
define("TWITTER_OAUTH_HOST","https://twitter.com");
define("TWITTER_REQUEST_TOKEN_URL", TWITTER_OAUTH_HOST . "/oauth/request_token");
define("TWITTER_AUTHORIZE_URL", TWITTER_OAUTH_HOST . "/oauth/authorize");
define("TWITTER_ACCESS_TOKEN_URL", TWITTER_OAUTH_HOST . "/oauth/access_token");
define("TWITTER_PUBLIC_TIMELINE_API", TWITTER_OAUTH_HOST . "/statuses/public_timeline.json");
define("TWITTER_USER_TIMELINE_API", TWITTER_OAUTH_HOST . "/statuses/user_timeline.json");

function fGetTweets($user = '', $count = 3) {

	$file = dirname('.') . $user . '.json';
	$options = array('consumer_key' => TWITTER_CONSUMER_KEY, 'consumer_secret' => TWITTER_CONSUMER_SECRET);
	OAuthStore::instance("2Leg", $options);	
	
	$json = new Services_JSON();	
	$last = getCacheLastModified($file);
	$now = time();

	if ( !$last || (( $now - $last ) > REFRESH_INTERVAL) ) {
		$response = readTimeline($user, $count);
		saveCache($file, $response);
	} else {
		$response = readCache($file);
	}
		
	$response = $json->decode($response);
	$response = wrapTweets($response);
	
	return $response;
}

function readTimeline($user, $count) {

	try {
	
		// Obtain a request object for the request we want to make
		$request = new OAuthRequester(TWITTER_REQUEST_TOKEN_URL, "POST");
		$result = $request->doRequest(0);
		parse_str($result['body'], $params);

		// now make the request.
		if ($user === false)
			$url = TWITTER_PUBLIC_TIMELINE_API;
		else
			$url = TWITTER_USER_TIMELINE_API . '?screen_name=' . $user . '&count=' . $count;
			
		$request = new OAuthRequester($url, 'GET', $params);		
		$result = $request->doRequest();
		$response = $result['body'];
		
	} catch(OAuthException2 $e) {
        $response = "Exception" . $e->getMessage();
	}
	
	return $response;
}

function wrapTweets($timeline) {

	if (!$timeline)
		return '<p>Unable to connect to twitter.</p>';

    // Create unorderer list of tweets (see gagawa module)
    $ul = new Ol();
    
    foreach( $timeline as $tweet ) {

        $text = $tweet->text;
        //Format date as 5 min ago, 2 hours ago, etc.
        $date = distance_of_time_in_words( strtotime($tweet->created_at) ) . ' ago';

        // Tweet source, i.e. twhril, tweetie, tweetdeck, etc. 
        // $source = $tweet->source;

        // Generate direct link to tweet
        $tweetid = $tweet->id;
        $screenname = $tweet->user->screen_name;
        $tweetlink = 'http://twitter.com/' . $screenname . '/status/' . $tweetid;

        // Turn links into links
        $text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
                '<a href="\\1" target="_blank">\\1</a>', $text); 
        // Turn twitter @username into links to the users Twitter page
        $text = preg_replace('/(^|\s)@(\w+)/',
                '\1<a href="http://www.twitter.com/\2" target="_blank">@\2</a>',
                $text);
        // Turn #hashtags into searches
        $text = preg_replace('/(^|\s)#(\w+)/',
                '\1<a href="http://search.twitter.com/search?q=%23\2" target="_blank">#\2</a>',
                $text);

        // Personal Formatting, see Gagawa for documentaiton.
        // <li>Tweet Text <span>(<a href="linktotweet">some time ago</a>)<span></li>
        $li = new Li();
        $ul->appendChild( $li );
 

        $span = new Span();
        $link = new A();
        $link->setHref( $tweetlink );
        $link->appendChild( new Text( $date ) );

        $span->appendChild( $link );
        //$li->appendChild($span);
	$li->appendChild(new Text( $text ));

    } //end foreach( $timeline as $tweet )

    // Returns the stack of li's enclosed by ul
    return $ul->write();
}

?>
