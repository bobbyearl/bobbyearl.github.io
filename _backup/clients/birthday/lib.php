<?php

$gstrFormatLink = ''
."\n" . '<li class="bUser">'
."\n" . '<a href="http://www.facebook.com/wall.php?id=%1$s">'
."\n" . '<img src="%2$s" alt="" /><br />'
."\n" . '%3$s<br />%4$s'
."\n" . '</a>'
."\n" . '</li>';

function fGenerateUserList($arrUsers)
{
	$strReturn = '';
	
	if (strcmp($arrUsers,'') != 0)
	{
		for ($intI = 0; $intI < sizeof($arrUsers); $intI += 1)
		{
			$strUID = $arrUsers[$intI]['uid'];
			$strPic = $arrUsers[$intI]['pic_square'];
			$strName = $arrUsers[$intI]['name'];
			$strBirthday = $arrUsers[$intI]['birthday'];

			if ($strPic == '')
				$strPic = 'http://static.ak.facebook.com/pics/q_default.gif';

			$strBirthday = date("F j", strtotime($strBirthday));

			$strReturn .= sprintf($GLOBALS['gstrFormatLink'],
				$strUID,
				$strPic,
				$strName,
				$strBirthday);		
				
			if (($intI + 1) % 5 == 0)
			{ $strReturn .= '</ul><ul class="clearfix">'; }	
		}
	}

	if ($strReturn == '')
	$strReturn = '<li class="bUser">No Birthdays</li>';	
	
	$strReturn = '<ul class="clearfix">' . $strReturn . '</ul>';
	
	return $strReturn;
}


function cmp($a, $b)
{
	return date('m-d', strtotime($a['birthday'])) > date('m-d', strtotime($b['birthday']));
}


function get_db_conn() {
  $conn = mysql_connect($GLOBALS['db_ip'], $GLOBALS['db_user'], $GLOBALS['db_pass']);
  mysql_select_db($GLOBALS['db_name'], $conn);
  return $conn;
}

function get_prints($user) {
  $conn = get_db_conn();
  $res = mysql_query('SELECT `from`, `to`, `time` FROM footprints WHERE `to`=' . $user . ' ORDER BY `time` DESC', $conn);
  $prints = array();
  while ($row = mysql_fetch_assoc($res)) {
    $prints[] = $row;
  }
  return $prints;
}


function fRecordUser()
{
	if (isset($_POST['fb_sig_user']) && isset($_POST['fb_sig_session_key']))
	{
		$conn = mysql_connect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass']) or die ('Error connecting to mysql');
		mysql_select_db($GLOBALS['dbname']);
	
		$fbid = $_POST['fb_sig_user'];
		$session = $_POST['fb_sig_session_key'];

		// CHECK IF USER IS IN DB AND ACTIVE
		$query = "SELECT logincount FROM users WHERE fbid = '" . $fbid . "'";
		$result = mysql_query($query);

		// Current User?
		if (mysql_num_rows($result) > 0)
		{			
			$count = mysql_fetch_row($result);
			
			// Update Session, Login Count, Last Login
			$query = "Update users Set "
				. "installed = true, "
				. "lastsession = '" . $session . "', "
				. "logincount = " . ($count[0] + 1) . ", "
				. "lastvisit = now() Where fbid = '" . $fbid . "'";
				
			mysql_query($query) or die(mysql_error());
		}		
		
		else
		{
			 //$facebook->api_client->profile_setFBML('', $user);
		
			// Insert
			$query = "Insert Into users (fbid, installed, lastsession, logincount, lastvisit) values ("
				. "'" . $fbid . "', "
				. "true, "
				. "'" . $session . "', "
				. "'1', "
				. "'now()')";
				
			mysql_query($query) or die(mysql_error());
		}
		
		mysql_close($conn);
			
	}
	
	return;
}

function fRecordAttachment()
{
	if (isset($_POST['fb_sig_user']) && isset($_POST['fb_sig_session_key']) && isset($_POST['t']))
	{
		$conn = mysql_connect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass']) or die ('Error connecting to mysql');
		mysql_select_db($GLOBALS['dbname']);
	
		$fbid = $_POST['fb_sig_user'];
		$session = $_POST['fb_sig_session_key'];

		// Insert
		$query = "Insert Into attachments (fbid, image, dt) values (" . $fbid . ", '" . $_POST['t'] . "', now())";
				
		mysql_query($query) or die(mysql_error());
		mysql_close($conn);
	}
	
	return;
}

function fRemoveUser()
{
	if (isset($_POST['fb_sig_user']))
	{
		$conn = mysql_connect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass']) or die ('Error connecting to mysql');
		mysql_select_db($GLOBALS['dbname']);
	
		$fbid = $_POST['fb_sig_user'];

		// CHECK IF USER IS IN DB AND ACTIVE
		$query = "SELECT * FROM users WHERE fbid = '" . $fbid . "'";
		$result = mysql_query($query) or die(fWriteToFile(mysql_error()));
		
		// Current User?
		if (mysql_num_rows($result) > 0)
		{			
			// Delete User
			$query = "Update users Set Installed = 0 Where fbid = '" . $fbid . "'";
			mysql_query($query) or die(fWriteToFile(mysql_error()));
			echo '<p>' . $query . '</p>';
		}	
	}
	
	return;
}

function fWriteToFile($contents)
{
	$myFile = "errors.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	fwrite($fh, $contents);
	fclose($fh);
	
	return;
}

function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return false;
}