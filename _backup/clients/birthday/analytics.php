<?php

if ($_GET['t'] != '')
	$strTitle = $_GET['t'];

?>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
_uacct = "UA-460794-6";
urchinTracker('<?php echo $strTitle ?>');
</script>
