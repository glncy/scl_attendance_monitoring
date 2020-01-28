<?php
$id=$_POST['id'];
$output="";
include('connection.php');

if ($_POST['type']=='position') {
	$query="DELETE FROM tbllists WHERE id='$id'";
	if (mysql_query($query)) {
		$query="SELECT * FROM tbllists WHERE type='position' ORDER BY id DESC";
		$get=mysql_query($query);
		while ($row=mysql_fetch_array($get)) {
			$output.="<tr>
				<td><center>".$row['title']."</center></td>
				<td><center><a href='#' onclick='del_list(\"".$row['id']."\",\"position\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></center></td>
			</tr>";
		}
	}
}
else if ($_POST['type']=='department') {
	$query="DELETE FROM tbllists WHERE id='$id'";
	if (mysql_query($query)) {
		$query="SELECT * FROM tbllists WHERE type='department' ORDER BY id DESC";
		$get=mysql_query($query);
		while ($row=mysql_fetch_array($get)) {
			$output.="<tr>
				<td><center>".$row['title']."</center></td>
				<td><center><a href='#' onclick='del_list(\"".$row['id']."\",\"department\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></center></td>
			</tr>";
		}
	}
}

else if ($_POST['type']=='holiday') {
	$query="DELETE FROM tblholidays WHERE id='$id'";
	if (mysql_query($query)) {
		$query="SELECT * FROM tblholidays ORDER BY id DESC";
		$get=mysql_query($query);
		while ($row=mysql_fetch_array($get)) {
			$output.="<tr>
				<td><center>".$row['holidays']."</center></td>
				<td><center><a href='#' onclick='del_list(\"".$row['id']."\",\"holiday\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></center></td>
			</tr>";
		}
	}
}

else if ($_POST['type']=='admin') {
	$output='<table class="table" width="100%"><tr>
									<td>Username</td>
									<td>Password</td>
									<td colspan="2">Action</td>
								</tr>';
	$query="DELETE FROM tbladmin WHERE id='$id'";
	if (mysql_query($query)) {
		$query="SELECT * FROM tbladmin ORDER BY id DESC";
		$get=mysql_query($query);
		while ($row=mysql_fetch_array($get)) {
			$output.="<tr>
				<td>".$row['user']."</td>
				<td>**********</td>
				<td><a href='#' data-toggle='modal' data-target='#edit_admin' onclick='edit_admin(".$row['id'].")'><span class='glyphicon glyphicon-pencil'></span>Edit</a></td>
										<td><a href='#' onclick='del_list(\"".$row['id']."\",\"admin\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></td>
									</tr>";
		}
		$output.='</table>';
	}
}
mysql_close();
echo $output;
?>