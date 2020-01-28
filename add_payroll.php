<?php
session_start();
$ref_id=$_POST['target_id'];
$from=$_POST['from_date'];
$to=$_POST['to_date'];
$gross=$_POST['gross_salary'];
$double=$_POST['double_pay'];
$overtime=$_POST['overtime_pay'];
$total_gross=$_POST['total_gross'];
$sss=$_POST['sss'];
$pagibig=$_POST['pagibig'];
$philhealth=$_POST['philhealth'];
$other_deduction=$_POST['other'];
$total_deduction=$_POST['total_deduction'];
$total_net=$_POST['total_net'];

include("connection.php");

$query="INSERT INTO tblpayroll (ref_id,to_date,from_date,gross,double_pay,overtime,total_gross,sss,pagibig,philhealth,other_deductions,total_deductions,total_net) VALUES ('$ref_id','$to','$from','$gross','$double','$overtime','$total_gross','$sss','$pagibig','$philhealth','$other_deduction','$total_deduction','$total_net')";

if (mysql_query($query) or die(mysql_error())) {
	$_SESSION['notification']="SUCCESS";
	$_SESSION['msg']="Payroll Added.";
	mysql_close();
	header("Location: payroll.php");
}
else
{
	$_SESSION['notification']="FAILED";
	$_SESSION['msg']="Failed to Add Payroll.";
	mysql_close();
	header("Location: payroll.php");
}
?>