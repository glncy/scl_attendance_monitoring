<?php
include("connection.php");
$query="SELECT * FROM tbltime ORDER BY id DESC LIMIT 10";
$get=mysql_query($query);
$output="";
while ($row=mysql_fetch_array($get)) {
	$id=$row['ref_id'];
	$query_2="SELECT * FROM tblemployee WHERE id='$id'";
	$get_2=mysql_query($query_2);
	$row_2=mysql_fetch_array($get_2);
	if (($row['time_in_date']!="")&&($row['time_out_date']!="")) {
		$output.= '<div class="col-sm-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<h6>'.$row_2['fname']." ".$row_2['lname'].' recently timed out.</h6>
								</div>
							</div>
						</div>';
	}
	else if (($row['time_in_date']!="")&&($row['time_out_date']=="")) {
		$output.=  '<div class="col-sm-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<h6>'.$row_2['fname']." ".$row_2['lname'].' recently timed in.</h6>
								</div>
							</div>
						</div>';
	}
}
mysql_close();
echo $output;
?>