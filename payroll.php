<?php
$location="payroll";
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
			<h1>Payroll</h1>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-5">
							<input type="text" name="Search" class="form-control" placeholder="Search Employee Name, ID ,Position or Department" id="search_payroll">
						</div>
						<div class="col-sm-5">
							<!---->
						</div>
						<div class="col-sm-2">
							<!--<input type="button" class="form-control btn btn-warning" value="Add Payroll" data-toggle="modal" data-target="#addEmployee" onclick="addId()">-->
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive" id="result_payroll">
								<table class="table">
									<thead>
										<tr>
											<th>Name</th>
											<th>ID No.</th>
											<th>Position</th>
											<th>Department</th>
											<th colspan="2">Action</th>
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
										echo "<tr><td>".$row['lname'].", ".$row['fname']." ".$row['mname']."</td><td>".$row['employee_id']."</td><td>".$row['position']."</td><td>".$row['department']."</td><td><a href='' data-toggle='modal' data-target='#add_payroll' onclick='transfer_id(".$row['id'].")'><span class='glyphicon glyphicon-plus'></span>Add</a></td><td><a href='' data-toggle='modal' data-target='#view_payroll' onclick='fetch_payroll(".$row['id'].")'><span class='glyphicon glyphicon-eye-open'></span>View Payrolls</a></td></tr>";
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
<div class="modal fade" id="add_payroll" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Add Payroll</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<label>Select Date:</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="input-group">
							<span class="input-group-addon">From</span>
							<input type="date" class="form-control" required id="from_salary">
						</div>
						<input type="text" id="ref_id" style="display: none;">
					</div>
					<div class="col-sm-5">
						<div class="input-group">
							<span class="input-group-addon">To</span>
							<input type="date" class="form-control" required id="to_salary">
						</div>
					</div>
					<div class="col-sm-2">
						<button class="btn btn-warning" onclick="fetch_salary();">Check</button>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<hr/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-12">
								<br/>
							</div>
							<div class="col-sm-12">
								<center><h4>Salary Deductions</h4></center>
							</div>
							<div class="col-sm-12">
								<br/>
							</div>
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon">Social Security System</span>
									<input type="number" class="form-control" required id="sss" onkeyup="transfer_value('sss');">

								</div>
							</div>
							<div class="col-sm-12">
								<br/>
							</div>
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon">PAG-IBIG Funds</span>
									<input type="number" class="form-control" required id="pagibig" onkeyup="transfer_value('pagibig');">
								</div>
							</div>
							<div class="col-sm-12">
								<br/>
							</div>
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon">PHILHEALTH Insurance</span>
									<input type="number" class="form-control" required id="philhealth" onkeyup="transfer_value('philhealth');">
								</div>
							</div>
							<div class="col-sm-12">
								<br/>
							</div>
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon">Other Deductions</span>
									<input type="number" class="form-control" required id="other" onkeyup="transfer_value('other');">
								</div>
							</div>
						</div>
					</div>
					<form class="form-group" enctype="multipart/form-data" method="POST" action="add_payroll.php">
					<input type="text" id="ref_id_2" style="display: none;" name="target_id">
					<div class="col-sm-6" style="border-left: 1px black solid;">
						<table width="100%" id="gross_salary">
							<tr>
								<td colspan="2"><center><h5>Salary<h5></center></td>
							</tr>
							<tr>
								<td width="65%">Gross Salary:</td>
								<td width="35%">&#8369;<input type="text" name="gross_salary" style="border: 0px;" readonly size="7" required></td>
							</tr>
							<tr>
								<td>Double Pay :</td>
								<td>&#8369;<input type="text" name="double_pay" size="7" style="border: 0px;" readonly required></td>
							</tr>
							<tr>
								<td>Overtime Pay :</td>
								<td>&#8369;<input type="text" name="overtime_pay" size="7" style="border: 0px;" readonly required></td>
							</tr>
							<tr>
								<td>Total Gross:</td>
								<td>&#8369;<input type="text" name="total_gross" size="7" style="border: 0px;" readonly required id="total_gross"></td>
							</tr>
							<tr>
								<td colspan="2"><center>------------------------------------------------------</center></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="2"><center><h5>Salary Deductions<h5></center></td>
							</tr>
							<tr>
								<td>Social Security System :</td>
								<td>&#8369;<input type="text" name="sss" size="7" style="border: 0px;" readonly id="sss_deduction" required></td>
							</tr>
							<tr>
								<td>PAG-IBIG Funds : </td>
								<td>&#8369;<input type="text" name="pagibig" size="7" style="border: 0px;" readonly id="pagibig_deduction" required></td>
							</tr>
							<tr>
								<td>PHILHEALTH Insurance : </td>
								<td>&#8369;<input type="text" name="philhealth" size="7" style="border: 0px;" readonly id="philhealth_deduction" required></td>
							</tr>
							<tr>
								<td>Other Deductions : </td>
								<td>&#8369;<input type="text" name="other" size="7" style="border: 0px;" readonly id="other_deduction" required></td>
							</tr>
							<tr>
								<td>Total Deductions : </td>
								<td>&#8369;<input type="text" name="total_deduction" size="7" style="border: 0px;" readonly id="total_deduction" required></td>
							</tr>
							<tr>
								<td colspan="2"><center>------------------------------------------------------</center></td>
								<td></td>
							</tr>
							<tr>
								<td><h4>Total Net Salary : <h4></td>
								<td>&#8369;<input type="text" name="total_net" size="7" style="border: 0px;" readonly style="font-size: 44pt;" required id="total_net"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" value="Submit" class="btn btn-warning">
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="view_payroll" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>View Payrolls</h4>
			</div>
			<!--<form class="form-group" enctype="multipart/form-data" method="POST">-->
				<div class="modal-body" id="view_payroll_result">
				</div>
				<!--<div class="modal-footer">
					<input type="button" value="Submit" class="btn btn-warning" onclick="add_announce();">
				</div>-->
			<!--</form>-->
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
			<form class="form-group" enctype="multipart/form-data" method="POST" action="paid_stamp.php">
				<div class="modal-body" id="payroll_details">
				</div>
				<div class="modal-footer">
					<input type="submit" value="Mark as Paid" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php
include("footer.php");
?>