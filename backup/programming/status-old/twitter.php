<?php

include_once "oauth-php-read-only/library/OAuthStore.php";
include_once "oauth-php-read-only/library/OAuthRequester.php";

define("TWITTER_CONSUMER_KEY", "BZ0hpuaecz0SKMhQnHUy1g");
define("TWITTER_CONSUMER_SECRET", "sLS4wMEBBn7CxcnnEpgQlJXc8w7i7aXOGZ2CzSVv8lE");

define("TWITTER_OAUTH_HOST","https://twitter.com");
define("TWITTER_REQUEST_TOKEN_URL", TWITTER_OAUTH_HOST . "/oauth/request_token");
define("TWITTER_AUTHORIZE_URL", TWITTER_OAUTH_HOST . "/oauth/authorize");
define("TWITTER_ACCESS_TOKEN_URL", TWITTER_OAUTH_HOST . "/oauth/access_token");
define("TWITTER_PUBLIC_TIMELINE_API", TWITTER_OAUTH_HOST . "/statuses/public_timeline.json");
define("TWITTER_UPDATE_STATUS_API", TWITTER_OAUTH_HOST . "/statuses/update.json");
define('OAUTH_TMP_DIR', function_exists('sys_get_temp_dir') ? sys_get_temp_dir() : realpath($_ENV["TMP"]));

function fGetTweets($user, $limit) {

	$options = array('consumer_key' => TWITTER_CONSUMER_KEY, 'consumer_secret' => TWITTER_CONSUMER_SECRET);
	OAuthStore::instance("2Leg", $options);

	try {
		// Obtain a request object for the request we want to make
		$request = new OAuthRequester(TWITTER_REQUEST_TOKEN_URL, "POST");
		$result = $request->doRequest(0);
		parse_str($result['body'], $params);

		// now make the request.
		$request = new OAuthRequester(TWITTER_PUBLIC_TIMELINE_API, 'GET', $params);
		$result = $request->doRequest();
		$response = $result['body'];
	}
	catch(OAuthException2 $e)
	{
        	$response = "Exception" . $e->getMessage();
	}

	return $response;
}

?>
