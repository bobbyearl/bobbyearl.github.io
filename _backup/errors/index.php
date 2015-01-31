<?php

if (!isset($_GET['code']))
	return;

switch ($_GET['code']) {
	case '404':
		$html = '<h1>404 Error</h1><p>Oh No Charles.</p>';

}

echo $html;

?>
