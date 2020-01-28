<?php
include('connection.php');
$output="";
if ($_POST['type']=='position') {
	$query="SELECT * FROM tbllists WHERE type='position' ORDER BY id DESC";
	$get=mysql_query($query);
	while ($row=mysql_fetch_array($get)) {
		$output.="<tr>
			<td><center>".$row['title']."</center></td>
			<td><center><a href='#' onclick='del_list(\"".$row['id']."\",\"position\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></center></td>
		</tr>";
	}
	mysql_close();
	echo $output;
}
elseif ($_POST['type']=='department') {
	$query="SELECT * FROM tbllists WHERE type='department' ORDER BY id DESC";
	$get=mysql_query($query);
	while ($row=mysql_fetch_array($get)) {
		$output.="<tr>
			<td><center>".$row['title']."</center></td>
			<td><center><a href='#' onclick='del_list(\"".$row['id']."\",\"department\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></center></td>
		</tr>";
	}
	mysql_close();
	echo $output;
}
elseif ($_POST['type']=='holiday') {
	$query="SELECT * FROM tblholidays ORDER BY id DESC";
	$get=mysql_query($query);
	while ($row=mysql_fetch_array($get)) {
		$output.="<tr>
			<td><center>".$row['holidays']."</center></td>
			<td><center><a href='#' onclick='del_list(\"".$row['id']."\",\"holiday\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></center></td>
		</tr>";
	}
	mysql_close();
	echo $output;
}

?>