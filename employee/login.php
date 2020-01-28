<?php
session_start();
if ((isset($_GET['id']))&&(isset($_GET['pw']))) {
	$id=mysql_real_escape_string($_GET['id']);
	$id=rtrim($id);
	$id=ltrim($id);

	$pw=mysql_real_escape_string($_GET['pw']);
	$pw=rtrim($pw);
	$pw=ltrim($pw);
	include('../connection.php');

	$query="SELECT * FROM tblemployee WHERE id='$id' AND pw='$pw'";
	$result=mysql_query($query);
	$num_rows=mysql_num_rows($result);
	if ($num_rows>0) {
		$row=mysql_fetch_array($result);
		$_SESSION['user_id']=$row['employee_id'];
		$_SESSION['pw']=$row['pw'];
		$_SESSION['login_id']=$row['id'];
		header("Location: dashboard.php");
	}
	else
	{
		echo "<center>ERROR IN LOG IN</center>";
	}
}
else
{
	echo "<center>ERROR IN LOG IN</center>";
}

?>