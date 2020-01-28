<?php
include('connection.php');
$query="TRUNCATE TABLE tbladmin";
$query2="TRUNCATE TABLE tblannounce";
$query3="TRUNCATE TABLE tblemployee";
$query4="TRUNCATE TABLE tblholidays";
$query5="TRUNCATE TABLE tbllists";
$query6="TRUNCATE TABLE tblpayroll";
$query7="TRUNCATE TABLE tbltime";

mysql_query($query7);
mysql_query($query6);
mysql_query($query5);
mysql_query($query4);
mysql_query($query3);
mysql_query($query2);
mysql_query($query);

$query="INSERT INTO tbladmin (user,pw) VALUES ('admin','1234')";
mysql_query($query);

$query="INSERT INTO tbllists (type,title) VALUES ('rate','0.00')";
mysql_query($query);

session_start();
session_destroy();
?>

<script type="text/javascript">
	alert('THE SYSTEM HAS BEEN RESET');
	window.location.href = "index.php";
</script>