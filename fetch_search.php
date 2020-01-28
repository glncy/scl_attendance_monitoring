<?php
$search=mysql_real_escape_string($_GET["search"]);
include('connection.php');
$query = "SELECT * FROM tblemployee WHERE fname LIKE '%$search%' OR lname LIKE '%$search%' OR mname LIKE '%$search%' OR employee_id LIKE '%$search%' OR position LIKE '%$search%'OR department LIKE '%$search%'";
$output='';
$result=mysql_query($query);
if (mysql_num_rows($result)>0) {
	$output .='<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>ID No.</th>
				<th>Position</th>
				<th>Department</th>
				<th colspan="3">Action</th>
			</tr>
		</thead>';
	while ($row = mysql_fetch_array($result)) {
		$output .="<tr><td>".$row['lname'].", ".$row['fname']." ".$row['mname']."</td><td>".$row['employee_id']."</td><td>".$row['position']."</td><td>".$row['department']."</td><td><a href='' onclick='fetch_details(\"".$row['id']."\",\"view\")' data-toggle='modal' data-target='#viewEmployee'><span class='glyphicon glyphicon-user'></span>View</a></td><td><a href='' onclick='fetch_details(\"".$row['id']."\",\"edit\")' data-toggle='modal' data-target='#editEmployee'><span class='glyphicon glyphicon-pencil'></span>Edit</a></td><td><a href='#' onclick='delButton(\"".$row['id']."\",\"".$row['lname'].", ".$row['fname']." ".$row['mname']."\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></td></tr>";
	}
	$output .= '</table>';
	echo $output;
}
else
{
	echo '<center>Data Not Found</center>';
}
?>