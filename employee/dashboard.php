<?php
$location="dashboard";
include('header_login.php');
?>
<div class="container">
	<div class="row">
		<div class="col-sm-2">
			<ul class="nav nav-pills nav-stacked" style="">
				<li class="active"><a data-toggle="pill" href="#profile">Profile</a></li>
				<li><a data-toggle="pill" href="#reports">Reports</a></li>
				<li><a data-toggle="pill" href="#payroll">My Payroll</a></li>
			</ul>
		</div>
		<div class="col-sm-10">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="profile">
					<div class="row">
						<div class="col-sm-12">
							<h1>Profile</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
					<div class="row">
						<?php
							include('../connection.php');
							$id=$_SESSION['login_id'];
							$query="SELECT * FROM tblemployee WHERE id='$id'";
							$get=mysql_query($query);
							$row=mysql_fetch_array($get);
							echo '
						<div class="col-sm-3">
							<div class="row">
								<div class="col-sm-12">
									<img src="../res/profile_pictures/'.$row['picture'].'" class="img-responsive">
								</div>
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-12">
									<center><h4>QR Code</h4></center>
								</div>
								<div class="col-sm-12">
									<img src="../qr_code_generator.php?value='.$row['pw'].'" class="img-responsive" style="width: 100%;">
								</div>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Employee ID</span>
										<input type="text" name="fname" class="form-control" readonly value="'.$row['employee_id'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">First Name</span>
										<input type="text" name="fname" class="form-control" readonly value="'.$row['fname'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Middle Name</span>
										<input type="text" name="mname" class="form-control" readonly value="'.$row['mname'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>	
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Last Name</span>
										<input type="text" name="lname" class="form-control" readonly value="'.$row['lname'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>	
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Gender</span>
										<input type="text" name="lname" class="form-control" readonly value="'.$row['gender'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>	
								<div class="col-sm-5">
									<div class="input-group">
										<span class="input-group-addon">House No.</span>
										<input type="number" name="house" class="form-control" readonly value="'.$row['house_no'].'">
									</div>
								</div>
								<div class="col-sm-7">
									<div class="input-group">
										<span class="input-group-addon">Street</span>
										<input type="text" name="street" class="form-control" readonly value="'.$row['street'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Barangay</span>
										<input type="text" name="barangay" class="form-control" readonly value="'.$row['barangay'].'">
									</div>
								</div>	
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">City/Municipality</span>
										<input type="text" name="municipality" class="form-control" readonly value="'.$row['municipality'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>	
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Contact Number</span>
										<input type="number" name="contact_number" class="form-control" readonly value="'.$row['contact_number'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>	
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Email Address</span>
										<input type="email" name="email" class="form-control" readonly value="'.$row['email'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>	
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Birthdate</span>
										<input type="date" name="birthdate" class="form-control" readonly value="'.$row['birthdate'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>	
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Position</span>
										<input type="text" name="position" class="form-control" readonly value="'.$row['position'].'">
									</div>
								</div>
								<div class="col-sm-12">
									<br/>
								</div>	
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">Department</span>
										<input type="text" name="department" class="form-control" readonly value="'.$row['department'].'">
									</div>
								</div>
							</div>'; 
							mysql_close();?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="reports">
					<div class="row">
						<div class="col-sm-12">
							<h1>Reports</h1>
						</div>
					</div>
					<div class="row">
						<center><h4>Duty Reports</h4></center>
					</div>
					<div class="row" id="employee_chart"></div>
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
					<div class="row">
						<form action="print_report.php?mode=timein&id=<?php echo $_SESSION['id']; ?>" target="timein_print" method="post">
						<div class="col-sm-6" style="border-right: 2px solid black;">
							<div class="row">
								<div class="col-sm-12">
									<center><h4>Time In Reports</h4></center>
								</div>
								<div class="col-sm-1">
								</div>
								<div class="col-sm-4">
									<label>From:</label>
									<input type="date" name="from" class="form-control" required>
								</div>
								<div class="col-sm-4">
									<label>To:</label>
									<input type="date" name="to" class="form-control" required>
								</div>
								<div class="col-sm-2">
									<label></label>
									<input type="submit" value="Search" class="btn btn-success" style="margin-top: 5px;">
								</div>
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-12">
									<iframe src="print_report.php?mode=timein&id=<?php echo $_SESSION['id']; ?>" name="timein_print" height="600px" width="100%"></iframe>
								</div>
							</div>
						</div>
						</form>
						<form action="print_report.php?mode=timeout&id=<?php echo $_SESSION['id']; ?>" target="timeout_print" method="post">
						<div class="col-sm-6" style="border-left: 2px solid black;">
							<div class="row">
								<div class="col-sm-12">
									<center><h4>Time Out Reports</h4></center>
								</div>
								<div class="col-sm-1">
								</div>
								<div class="col-sm-4">
									<label>From:</label>
									<input type="date" name="from" class="form-control" required>
								</div>
								<div class="col-sm-4">
									<label>To:</label>
									<input type="date" name="to" class="form-control" required>
								</div>
								<div class="col-sm-2">
									<label></label>
									<input type="submit" value="Search" class="btn btn-success" style="margin-top: 5px;">
								</div>
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-12">
									<iframe src="print_report.php?mode=timeout&id=<?php echo $_SESSION['id']; ?>" name="timeout_print" height="600px" width="100%"></iframe>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
				<div class="tab-pane fade" id="payroll">
					<div class="row">
						<div class="col-sm-12">
							<h1>My Payroll</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<table class="table">
								<thead>
									<tr>
										<th>Date Range</th>
										<th colspan="2">Action</th>
									</tr>
								</thead>
								<?php
								include('../connection.php');
								$output="";
								$ref_id=$_SESSION['login_id'];
								$query="SELECT * FROM tblpayroll WHERE ref_id='$ref_id' AND status='paid' ORDER BY id DESC";
								$get=mysql_query($query);
								$num_rows=mysql_num_rows($get);
								if ($num_rows>0) {
									while ($row=mysql_fetch_array($get)) {
										if ($row['status']=='paid') {
												$output.='<tr>
															<td>'.date("M jS, Y",strtotime($row['from_date']))." - ".date("M jS, Y",strtotime($row['to_date'])).'</td>
															<td colspan="2"><a href="" data-toggle="modal" data-target="#view_payroll_details" onclick="fetch_payroll_details('.$row['id'].')"><span class="glyphicon glyphicon-list-alt"></span>View</a></td>
														</tr>';
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
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="view_payroll_details" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>View Payroll Details</h4>
			</div>
			<!--<form class="form-group" enctype="multipart/form-data" method="POST">-->
				<div class="modal-body" id="payroll_details">
				</div>
				<!--<div class="modal-footer">
					<input type="button" value="Submit" class="btn btn-warning" onclick="add_announce();">
				</div>-->
			<!--</form>-->
		</div>
	</div>
</div>
<?php
include('footer.php');
?>