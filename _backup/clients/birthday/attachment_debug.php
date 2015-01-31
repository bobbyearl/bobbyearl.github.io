<?
if (!array_key_exists('message_sent', $_POST) || $_POST['message_sent'] < 1)
  {
    // The user is selecting the attachment, in other words, preview mode
    // Print out form elements that allow the user to select the attachment
    // In this example, the attachment is simply a bit of text we will collect in the 'sample' input field
    // If the 'sample' exists in _POST, then we are actually previewing. Else, we are here the first time
    //   to collect that text
    if (array_key_exists('sample', $_POST))
        echo '<fb:editor-text label="Sample" name="sample" id="sample" value="'. htmlspecialchars($_POST['sample']) . '"/>';
    else
        echo '<fb:editor-text label="Sample" name="sample" id="sample" value="type something here"/>';

    // The following line tells facebook to use the same script for attachments, but you don't need to. You can use a seperate script.
    echo '<input type="hidden" name="url" value="http://simplyearl.com/birthday/attachment_debug.php" />';

    // The following line lets your user preview the attachment they've selected. This is not required.
    echo "<fb:attachment-preview>Click here to preview attachment</fb:attachment-preview><br /><br />";

    echo "<b>Preview:</b>";
    echo "<hr />";
  }
  else
  {
    // Do anything here you want to do for attached objects only
    echo "(The object is attached)<br/><br/>";
  }

  // Display your attachment here.  This will show up both for preview and live attachments
  if (array_key_exists('sample', $_POST))
    echo "You wrote <b>" . htmlspecialchars($_POST['sample']) . "</b><br />";
?>

