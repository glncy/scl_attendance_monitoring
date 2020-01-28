<?php
$user=mysql_real_escape_string($_POST['user']);
$pw=mysql_real_escape_string($_POST['pw']);
$id=mysql_real_escape_string($_POST['id']);

include('connection.php');

$query="UPDATE tbladmin SET user='$user', pw='$pw' WHERE id='$id'";

if (mysql_query($query)) {
	mysql_close();
	header("Location: settings.php");
}
else
{
	mysql_close();
	header("Location: settings.php");
}
?>