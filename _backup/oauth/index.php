<?

/*

CLIENT INFO
CLIENT ID	b0bccadade954c64b7ed35593219b1fa
CLIENT SECRET	2c16090d0666446782611de5cba31bdb
WEBSITE URL	http://www.bobbyearl.com
REDIRECT URI	http://www.bobbyearl.com/oauth
*/

$CLIENT_ID = 'b0bccadade954c64b7ed35593219b1fa';
$REDIRECT_URI = 'http://www.bobbyearl.com/oauth';

if (isset($_GET['REDIRECT'])) {
	header("Location: https://api.instagram.com/oauth/authorize/?client_id=$CLIENT_ID&redirect_uri=$REDIRECT_URI&response_type=code");
}

?>
