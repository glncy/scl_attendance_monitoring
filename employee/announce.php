<?php
include('../connection.php');
if (isset($_POST['id']))
{
	$id=$_POST['id'];
	$query="DELETE FROM tblannounce WHERE id='$id'";
	mysql_query($query);
}
$output="";
$query="SELECT * FROM tblannounce";
$get=mysql_query($query) or die(mysql_error());
if (mysql_num_rows($get)!=0) {
	while ($row=mysql_fetch_array($get)) {
		$output.= "<div class='col-sm-12' style='border: 2px solid rgba(100, 101, 102,0.2); border-radius: 10px;'>
		<div class='row'>
			<div class='col-sm-12'>
			<h4>".$row['title']."</h4>
			</div>
			<div class='col-sm-12'>
			<p>".$row['description']."</p>
			</div>
		</div>
		</div>";
	}
	mysql_close();
}
else
{
	mysql_close();
}
echo $output;
?>