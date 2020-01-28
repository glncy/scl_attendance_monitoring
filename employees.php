<?php
$location="employees";
include("header.php");
?>
<div class="container">
	<div class="row" id="notif">
		<div class="col-sm-12">
			<?php
			if (isset($_SESSION['notification']))
			{
				if ($_SESSION['notification']=='SUCCESS')
				{
					echo "<h6 style='background-color: Green; padding: 10px;color:white;'>".$_SESSION['msg']."</h6>";
					unset($_SESSION['notification']);
					unset($_SESSION['msg']);
				}
				else if ($_SESSION['notification']=='FAILED')
				{
					echo "<h6 style='background-color: Green;color: white;'>".$_SESSION['msg']."</h6>";
					unset($_SESSION['notification']);
					unset($_SESSION['msg']);
				}
			}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<h1>Employees</h1>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-5">
							<input type="text" name="Search" class="form-control" placeholder="Search Employee Name, ID ,Position or Department" id="search">
						</div>
						<div class="col-sm-5">
							<!---->
						</div>
						<div class="col-sm-2">
							<input type="button" class="form-control btn btn-warning" value="Add Employees" data-toggle="modal" data-target="#addEmployee" onclick="addId()">
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive" id="result">
								<table class="table">
									<thead>
										<tr>
											<th>Name</th>
											<th>ID No.</th>
											<th>Position</th>
											<th>Department</th>
											<th colspan="3">Action</th>
										</tr>
									</thead>
									<!--<tr>
										<td>Glency</td>
										<td>Glency</td>
										<td>Glency</td>
										<td>Glency</td>
										<td><a href=""><span class="glyphicon glyphicon-user"></span>View</a></td>
										<td><a href=""><span class="glyphicon glyphicon-pencil"></span>Edit</a></td>
										<td><a href=""><span class="glyphicon glyphicon-trash"></span>Delete</a></td>
									</tr>-->
									<?php
									include("connection.php");
									$query="SELECT * FROM tblemployee";
									$get=mysql_query($query);
									while ($row=mysql_fetch_array($get))
									{
										echo "<tr><td>".$row['lname'].", ".$row['fname']." ".$row['mname']."</td><td>".$row['employee_id']."</td><td>".$row['position']."</td><td>".$row['department']."</td><td><a href='' onclick='fetch_details(\"".$row['id']."\",\"view\")' data-toggle='modal' data-target='#viewEmployee'><span class='glyphicon glyphicon-user'></span>View</a></td><td><a href='' onclick='fetch_details(\"".$row['id']."\",\"edit\")' data-toggle='modal' data-target='#editEmployee'><span class='glyphicon glyphicon-pencil'></span>Edit</a></td><td><a href='#' onclick='delButton(\"".$row['id']."\",\"".$row['lname'].", ".$row['fname']." ".$row['mname']."\")'><span class='glyphicon glyphicon-trash'></span>Delete</a></td></tr>";
									}
									mysql_close();
									?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addEmployee" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>New Employee</h4>
			</div>
			<form class="form-group" action="add_employee.php" enctype="multipart/form-data" method="POST">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-3">
							<img src="" class="img-responsive" id='img_src'>
						</div>
						<div class="col-sm-6">
							<div>
								<label>Profile Image</label>
								<input type="file" name="pic" id="photo" onchange="PreviewImage();">
							</div>
						</div>
						<div class="col-sm-12">
							<hr/>
						</div>
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">First Name</span>
								<input type="text" name="fname" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Middle Name</span>
								<input type="text" name="mname" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>	
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Last Name</span>
								<input type="text" name="lname" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>	
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Gender</span>
								<select class="form-control" name="gender" required>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>	
						<div class="col-sm-5">
							<div class="input-group">
								<span class="input-group-addon">House No.</span>
								<input type="number" name="house" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="input-group">
								<span class="input-group-addon">Street</span>
								<input type="text" name="street" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Barangay</span>
								<input type="text" name="barangay" class="form-control" required>
							</div>
						</div>	
						<div class="col-sm-12">
							<br/>
						</div>
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">City/Municipality</span>
								<input type="text" name="municipality" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>	
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Contact Number</span>
								<input type="number" name="contact_number" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>	
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Email Address</span>
								<input type="email" name="email" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>	
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Birthdate</span>
								<input type="date" name="birthdate" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>	
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Position</span>
								<select class="form-control" name="position" required>
									<?php
									include('connection.php');
									$query="SELECT * FROM tbllists WHERE type='position'";
									$get=mysql_query($query);
									while ($row=mysql_fetch_array($get)) {
										echo '<option value="'.$row['title'].'">'.$row['title'].'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>	
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Department</span>
								<select class="form-control" name="department" required>
									<?php
									include('connection.php');
									$query="SELECT * FROM tbllists WHERE type='department'";
									$get=mysql_query($query);
									while ($row=mysql_fetch_array($get)) {
										echo '<option value="'.$row['title'].'">'.$row['title'].'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<hr/>
						</div>	
						<div class="col-sm-5">
							<div class="input-group">
								<span class="input-group-addon">ID No.</span>
								<input type="text" name="employee_id" class="form-control" required readonly id="employee_id">
								<!--<button class="input-group-addon" type="button"><span class="glyphicon glyphicon-refresh"></span></button>-->
							</div>
						</div>
						<div class="col-sm-7">
							<div class="input-group">
								<span class="input-group-addon">Password</span>
								<input type="password" name="pw" class="form-control" required id="pw" onkeyup="qr_code_generator()">
							</div>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>
						<div class="col-sm-12">
							<center><h4>QR Code</h4></center>
						</div>
						<div class="col-sm-12">
							<div id="qr_code">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" name="Submit" value="Add" class="btn btn-warning">
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="viewEmployee" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>View Employee</h4>
			</div>
			<form class="form-group" enctype="multipart/form-data" method="POST">
				<div class="modal-body" id="view_details">
				</div>
				<div class="modal-footer">
					<input type="button" name="Submit" value="Print" class="btn btn-warning">
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="editEmployee" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Edit Employee</h4>
			</div>
			<form class="form-group" enctype="multipart/form-data" method="POST" action="edit_employee.php">
				<div class="modal-body" id="edit_details">
				</div>
				<div class="modal-footer">
					<input type="submit" name="Submit" value="Submit" class="btn btn-warning">
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>