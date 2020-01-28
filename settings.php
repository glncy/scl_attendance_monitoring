<?php
$location="settings";
include('header.php');?>

<div class="container">
	<div class="row">
		<div class="col-sm-2">
			<ul class="nav nav-pills nav-stacked" style="">
				<li class="active"><a data-toggle="pill" href="#admin">Administrator</a></li>
				<li><a data-toggle="pill" href="#system">System Settings</a></li>
				<!--<li><a data-toggle="pill" href="#payroll">About</a></li>-->
			</ul>
		</div>
		<div class="col-sm-10">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="admin">
					<div class="row">
						<div class="col-sm-12">
							<h1>Administrator</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6" id="admin_list">
							<table class="table" width="100%">
								<tr>
									<td>Username</td>
									<td>Password</td>
									<td colspan="2">Action</td>
								</tr>
								<?php
								include('connection.php');
								$query="SELECT * FROM tbladmin ORDER BY id DESC";
								$get=mysql_query($query);
								while ($row=mysql_fetch_array($get)) {
									echo "<tr>
										<td>".$row['user']."</td>
										<td>**********</td>
										<td><a href='#' data-toggle='modal' data-target='#edit_admin' onclick='edit_admin(".$row['id'].")'><span class='glyphicon glyphicon-pencil'></span>Edit</a></td>
										<td><a href='#' onclick='del_list(\"".$row['id']."\",\"admin\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></td>
									</tr>";
								}
								mysql_close();
								?>
							</table>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<div class="col-sm-12">
									<h3>Add Administrator</h3>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Username</span>
										<input type="text" class="form-control" required id="user">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Password</span>
										<input type="password" class="form-control" required id="pw">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-12">
									<button class="btn btn-success pull-right" onclick="add_list('admin')">Register</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="system">
					<div class="row">
						<div class="col-sm-12">
							<h1>System Settings</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
					<div class="row" id="report">
					</div>
					<?php
					include('connection.php');
					$query="SELECT * FROM tbllists WHERE type='rate'";
					$get=mysql_query($query) or die(mysql_error());
					$row=mysql_fetch_array($get);
					echo '<div class="row">
						<div class="col-sm-6">
							<span>Rate Per Hour : </span><input type="number" id="rate_per_hour" value="'.$row['title'].'"">&nbsp<button type="button" onclick="update_rph()">Save</button>
						</div>
					</div>';
					mysql_close();
					?>
					<div class="row">
						<div class="col-sm-12">
							<br/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-sm-4">
											<h4>Positions</h4>
										</div>
										<div class="col-sm-2">
											<!---->
										</div>
										<div class="col-sm-6">
											<input type="button" class="form-control btn btn-warning" value="Add Position" data-toggle="modal" data-target="#add_position">
										</div>
									</div>
								</div>
								<div class="panel-body">
									<table class="table" style="width: 100%;" id="position_list">
										<?php
										include('connection.php');
										$query="SELECT * FROM tbllists WHERE type='position'";
										$get=mysql_query($query);
										while ($row=mysql_fetch_array($get)) {
											echo "<tr>
												<td><center>".$row['title']."</center></td>
												<td><center><a href='#' onclick='del_list(\"".$row['id']."\",\"position\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></center></td>
											</tr>";
										}
										mysql_close();
										?>
									</table>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-sm-3">
											<h4>Department</h4>
										</div>
										<div class="col-sm-2">
											<!---->
										</div>
										<div class="col-sm-7">
											<input type="button" class="form-control btn btn-warning" value="Add Department" data-toggle="modal" data-target="#add_department">
										</div>
									</div>
								</div>
								<div class="panel-body">
									<table class="table" style="width: 100%;" id="department_list">
										<?php
										include('connection.php');
										$query="SELECT * FROM tbllists WHERE type='department'";
										$get=mysql_query($query);
										while ($row=mysql_fetch_array($get)) {
											echo "<tr>
												<td><center>".$row['title']."</center></td>
												<td><center><a href='#' onclick='del_list(\"".$row['id']."\",\"department\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></center></td>
											</tr>";
										}
										mysql_close();
										?>
									</table>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-sm-3">
											<h4>Holidays</h4>
										</div>
										<div class="col-sm-2">
											<!---->
										</div>
										<div class="col-sm-7">
											<input type="button" class="form-control btn btn-warning" value="Add Holiday" data-toggle="modal" data-target="#add_holiday">
										</div>
									</div>
								</div>
								<div class="panel-body">
									<table class="table" style="width: 100%;" id="holiday_list">
										<?php
										include('connection.php');
										$query="SELECT * FROM tblholidays";
										$get=mysql_query($query);
										while ($row=mysql_fetch_array($get)) {
											echo "<tr>
												<td><center>".$row['holidays']."</center></td>
												<td><center><a href='#' onclick='del_list(\"".$row['id']."\",\"holiday\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></center></td>
											</tr>";
										}
										mysql_close();
										?>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h3>Reset System</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<br/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<span>WARNING: THIS WILL RESET THE ALL DATA IN THE SYSTEM : </span><button type="button" onclick="reset();">RESET</button>
							</div>
						</div>
					</div>
				</div>
				<!--<div class="tab-pane fade" id="payroll">
					<h1>My Payroll</h1>
				</div>-->
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="add_position" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Add Position</h4>
			</div>
			<!--<form class="form-group" enctype="multipart/form-data" method="POST">-->
				<div class="modal-body" id="position_modal">
					<div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Position</span>
								<input type="text" class="form-control" required id="txtPosition">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" value="Add" class="btn btn-warning" onclick="add_list('position');">
				</div>
			<!--</form>-->
		</div>
	</div>
</div>
<div class="modal fade" id="add_department" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Add Department</h4>
			</div>
			<!--<form class="form-group" enctype="multipart/form-data" method="POST">-->
				<div class="modal-body" id="department_modal">
					<div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Department</span>
								<input type="text" class="form-control" required id="txtDepartment">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" value="Submit" class="btn btn-warning" onclick="add_list('department');">
				</div>
			<!--</form>-->
		</div>
	</div>
</div>
<div class="modal fade" id="add_holiday" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Add Holiday</h4>
			</div>
			<!--<form class="form-group" enctype="multipart/form-data" method="POST">-->
				<div class="modal-body" id="holiday_modal">
					<div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Holiday</span>
								<input type="date" class="form-control" required id="txtHoliday">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" value="Submit" class="btn btn-warning" onclick="add_list('holiday');">
				</div>
			<!--</form>-->
		</div>
	</div>
</div>
<div class="modal fade" id="edit_admin" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Edit</h4>
			</div>
			<form class="form-group" enctype="multipart/form-data" method="POST" action="update_admin.php">
				<div class="modal-body" id="edit_modal">
				</div>
				<div class="modal-footer">
					<input type="Submit" value="Submit" class="btn btn-warning">
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include('footer.php');
?>