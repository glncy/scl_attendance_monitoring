<?php
session_start();
include('connection.php');
$id=$_GET['id'];
$query="SELECT * FROM tblemployee WHERE id='$id'";
$get=mysql_query($query);
$row=mysql_fetch_array($get);
$picture=$row['picture'];
$query="DELETE FROM tblemployee WHERE id='$id'";
if (mysql_query($query) or die(mysql_error()))
{
	unlink("res/profile_pictures/".$picture);
	$_SESSION['notification']="SUCCESS";
	$_SESSION['msg']="Employee Deleted.";
	mysql_close();
	header("Location: employees.php");
}
else
{
	$_SESSION['notification']="FAILED";
	$_SESSION['msg']="Failed to Delete Employee.";
	mysql_close();
	header("Location: employees.php");
}
?>