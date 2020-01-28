<?php 
include('../connection.php');
session_start();
$id = $_GET['id'];
$mode = $_GET['mode'];
$ref="";
if (isset($_GET['ref'])) {
	$ref = $_GET['ref'];
}
$date = date('Y-m-d');
$time = date('H:i:s');
if ($mode=='timein') {
	$query="INSERT INTO tbltime (ref_id,time_in_date,time_in_time) VALUES ('$id','$date','$time')";
	mysql_query($query);
	echo "timein";
	$_SESSION['id']=$id;
	$_SESSION['mode']="timein";
	header("Location: index.php");
}
elseif ($mode=='timeout') {
	$query="UPDATE tbltime SET time_out_date='$date',time_out_time='$time' WHERE id='$id'";
	mysql_query($query) or die(mysql_error());
	echo "timeout";
	echo $ref;
	$_SESSION['id']=$ref;
	$_SESSION['mode']="timeout";
	header("Location: index.php");
}
?>