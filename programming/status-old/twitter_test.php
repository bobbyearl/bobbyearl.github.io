<?php

$url = 'http://twitter.com/statuses/user_timeline/simplyearl.json';

$curl_handle = curl_init(); // Open up a CURL connection
curl_setopt($curl_handle, CURLOPT_URL, "$url");
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2); // Timeout connecting in 2 seconds
curl_setopt($curl_handle, CURLOPT_TIMEOUT, 20); // Timeout getting data in 20 seconds (since Twitter has been slow with growing popularity)
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1); // Get data back

$buffer = curl_exec($curl_handle); // Execute the request and get data back
curl_close($curl_handle); // Close the connection!

if ($buffer) { // If data is returned
	$data = json_decode($buffer); // Decode JSON string

	$twitter_when = date('n/j/Y g:ia',abs(strtotime($data[0]->created_at . " GMT"))); // When was last tweet posted?
	$twitter_text = $data[0]->text; // Last tweet
} else { // Otherwise
	die("Couldn't fetch data"); // Error occurred while fetching, most likely a timeout
}

echo $twitter_when . ' - ' . $twitter_text;

?>