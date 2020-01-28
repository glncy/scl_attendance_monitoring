<?php
include('connection.php');
$output="";
if ($_POST['type']=='position') {
	$title=mysql_real_escape_string($_POST['title']);
	$query="INSERT INTO tbllists (title,type) VALUES ('$title','position')";
	if (mysql_query($query) or die(mysql_error())) {
		$output .= "<script type='text/javascript'>
		setTimeout(function() {
		    $('#msg').fadeOut('slow');
		}, 4000); // <-- time in milliseconds
	</script>";
		$output .='<div class="row" id="msg">
						<div class="col-sm-12">
							<h6 style="padding:10px;color:white;background-color:green;">Position Added!</h6>
						</div>
					</div>';
		$output .='<div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Position</span>
								<input type="text" class="form-control" required id="txtPosition">
							</div>
						</div>
					</div>';
	}
	else
	{
		$output .= "<script type='text/javascript'>
		setTimeout(function() {
		    $('#msg').fadeOut('slow');
		}, 4000); // <-- time in milliseconds
	</script>";
		$output .='<div class="row" id="msg">
						<div class="col-sm-12">
							<h6 style="padding:10px;color:white;background-color:red;">Failed to Add Position!</h6>
						</div>
					</div>';
		$output .='<div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Position</span>
								<input type="text" class="form-control" required id="txtPosition">
							</div>
						</div>
					</div>';
	}
}
elseif ($_POST['type']=='department') {
	$title=mysql_real_escape_string($_POST['title']);
	$query="INSERT INTO tbllists (title,type) VALUES ('$title','Department')";
	if (mysql_query($query)) {
		$output .= "<script type='text/javascript'>
		setTimeout(function() {
		    $('#msg').fadeOut('slow');
		}, 4000); // <-- time in milliseconds
	</script>";
		$output .='<div class="row" id="msg">
						<div class="col-sm-12">
							<h6 style="padding:10px;color:white;background-color:green;">Department Added!</h6>
						</div>
					</div>';
		$output .='<div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Department</span>
								<input type="text" class="form-control" required id="txtDepartment">
							</div>
						</div>
					</div>';
	}
	else
	{
		$output .= "<script type='text/javascript'>
		setTimeout(function() {
		    $('#msg').fadeOut('slow');
		}, 4000); // <-- time in milliseconds
	</script>";
		$output .='<div class="row" id="msg">
						<div class="col-sm-12">
							<h6 style="padding:10px;color:white;background-color:red;">Failed to Add Department!</h6>
						</div>
					</div>';
		$output .='<div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Department</span>
								<input type="text" class="form-control" required id="txtDepartment">
							</div>
						</div>
					</div>';
	}
}
elseif ($_POST['type']=='holiday') {
	$title=mysql_real_escape_string($_POST['title']);
	$query="INSERT INTO tblholidays (holidays) VALUES ('$title')";
	if (mysql_query($query) or die(mysql_error())) {
		$output .= "<script type='text/javascript'>
		setTimeout(function() {
		    $('#msg').fadeOut('slow');
		}, 4000); // <-- time in milliseconds
	</script>";
		$output .='<div class="row" id="msg">
						<div class="col-sm-12">
							<h6 style="padding:10px;color:white;background-color:green;">Holiday Added!</h6>
						</div>
					</div>';
		$output .='<div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Holiday</span>
								<input type="date" class="form-control" required id="txtHoliday">
							</div>
						</div>
					</div>';
	}
	else
	{
		$output .= "<script type='text/javascript'>
		setTimeout(function() {
		    $('#msg').fadeOut('slow');
		}, 4000); // <-- time in milliseconds
	</script>";
		$output .='<div class="row" id="msg">
						<div class="col-sm-12">
							<h6 style="padding:10px;color:white;background-color:red;">Failed to Add Holiday!</h6>
						</div>
					</div>';
		$output .='<div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Department</span>
								<input type="text" class="form-control" required id="txtHoliday">
							</div>
						</div>
					</div>';
	}
}
elseif ($_POST['type']=='admin') {
	$output='<table class="table" width="100%"><tr>
									<td>Username</td>
									<td>Password</td>
									<td colspan="2">Action</td>
								</tr>';
	$user=mysql_real_escape_string($_POST['user']);
	$pw=mysql_real_escape_string($_POST['pw']);
	$query="INSERT INTO tbladmin (user,pw) VALUES ('$user','$pw')";
	if (mysql_query($query) or die(mysql_error())) {
		$output .= "<script type='text/javascript'>alert('Successfully Added!');</script>";
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
	else
	{
		$output .= "<script type='text/javascript'>alert('Failed to Add.');</script>";
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