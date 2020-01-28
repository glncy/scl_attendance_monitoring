<?php
include('connection.php');
$ref_id=$_POST['id'];
$output='<table class="table">
		<thead>
			<tr>
				<th>Date Range</th>
				<th>Status</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>';

$query="SELECT * FROM tblpayroll WHERE ref_id='$ref_id' ORDER BY id DESC";
$get=mysql_query($query);
$num_rows=mysql_num_rows($get);
if ($num_rows>0) {
	while ($row=mysql_fetch_array($get)) {
		if ($row['status']=='paid') {
				$output.='<tr>
							<td>'.date("M jS, Y",strtotime($row['from_date']))." - ".date("M jS, Y",strtotime($row['to_date'])).'</td>
							<td>Paid</td>
							<td colspan="2"><a href="" data-toggle="modal" data-target="#view_payroll_details" onclick="fetch_payroll_details('.$row['id'].')"><span class="glyphicon glyphicon-list-alt"></span>View</a></td>
						</tr>';
			}	
		else
		{
			$output.='<tr><td>'.date("M jS, Y",strtotime($row['from_date']))." - ".date("M jS, Y",strtotime($row['to_date'])).'</td>
			<td>Not yet Paid</td>
			<td><a href="" data-toggle="modal" data-target="#view_payroll_details" onclick="fetch_payroll_details('.$row['id'].')"><span class="glyphicon glyphicon-list-alt"></span>View</a></td>
			<td><a href="#" onclick="del_payroll('.$row['id'].','.$ref_id.')"><span class="glyphicon glyphicon-trash"></span>Delete</a></td></tr>';
		}
	}
	$output.="</table>";
}
else
{
	$output='<table class="table"><tr><td><center>No Added Payroll</center></td></tr></table>';
}
mysql_close();
echo $output;
?>