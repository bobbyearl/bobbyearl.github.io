<?php

include_once 'config.php';
include_once 'lib.php';

$t = $_GET['t'];

echo sprintf($GLOBALS['strFlash'], 'f' . $t . '.swf');

?>