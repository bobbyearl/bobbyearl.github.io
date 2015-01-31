<?php
  // Get all the related keywords from Google Suggest
  $u = "http://google.com/complete/search?output=toolbar";
  $u = $u . "&q=" . $_REQUEST['msg'];

  // Using the curl library since dreamhost doesn't allow fopen
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $u);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $xml = simplexml_load_string(curl_exec($ch));
  curl_close($ch);

  // Parse the keywords and echo them out to the IM window
  $result = $xml->xpath('//@data');
  while (list($key, $value) = each($result)) {
    echo $value ."<br>";
  }
?>
