<?php
include('connection.php');
$id=$_POST['id'];

$query="UPDATE tblpayroll SET status='paid' WHERE id='$id'";
if (mysql_query($query)) {
	echo '<script type="text/javascript">
	alert(\'Marked as Paid.\');
	window.location.href = "payroll.php";
</script>';
}
else
{
		echo '<script type="text/javascript">
	alert(\'Failed to Mark as Paid.\');
	window.location.href = "payroll.php";
</script>';
}
?>