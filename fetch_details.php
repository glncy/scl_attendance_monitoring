<?php
$id=$_POST['id'];
$mode=$_POST['mode'];
include('connection.php');
$output="";
$query="SELECT * FROM tblemployee WHERE id='$id'";
$get=mysql_query($query);
$row=mysql_fetch_array($get);
if ($mode=="view") {
	echo '<div class="row">
			<div class="col-sm-4">
				<div class="col-sm-12">
					<center><h4>Profile Picture</h4></center>
				</div>
				<div class="col-sm-12">
					<img src="res/profile_pictures/'.$row['picture'].'" class="img-responsive">
				</div>
				<div class="col-sm-12">
					<center><hr/></center>
				</div>
				<div class="col-sm-12">
					<center><h4>QR Code</h4></center>
				</div>
				<div class="col-sm-12">
					<center><img src="qr_code_generator.php?value='.$row['pw'].'" class="img-responsive" width="50%"></center>
				</div>
				<div class="col-sm-12">
					<center><a href="qr_code_generator.php?value='.$row['pw'].'" download>Download</a></center>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="row">
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
					<div class="col-sm-12">
						<hr/>
					</div>	
					<div class="col-sm-5">
						<div class="input-group">
							<span class="input-group-addon">ID No.</span>
							<input type="text" name="employee_id" class="form-control" readonly value="'.$row['employee_id'].'">
						</div>
					</div>
					<div class="col-sm-7">
						<div class="input-group">
							<span class="input-group-addon">Password</span>
							<input type="password" name="pw" class="form-control" readonly value="'.$row['pw'].'">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<hr/>
		</div>
		<div class="row">
			<center><h4>Duty Reports</h4></center>
		</div>
		<div class="row" id="employee_chart"></div>';	
}
elseif ($mode=="edit") {
	echo '<div class="row">
			<div class="col-sm-3">
				<img src="res/profile_pictures/'.$row['picture'].'" class="img-responsive" id="img_src_edit">
			</div>
			<div class="col-sm-6">
				<div>
					<label>Profile Image</label>
					<input type="file" name="pic" onchange="PreviewImage_edit()" id="photo_edit">
				</div>
			</div>
			<div class="col-sm-12">
				<hr/>
			</div>
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">First Name</span>
					<input type="text" name="fname" class="form-control" required value="'.$row['fname'].'">
				</div>
			</div>
			<div class="col-sm-12">
				<br/>
			</div>
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">Middle Name</span>
					<input type="text" name="mname" class="form-control" required value="'.$row['mname'].'">
				</div>
			</div>
			<div class="col-sm-12">
				<br/>
			</div>	
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">Last Name</span>
					<input type="text" name="lname" class="form-control" required value="'.$row['lname'].'">
				</div>
			</div>
			<div class="col-sm-12">
				<br/>
			</div>	
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">Gender</span>
					';
			if ($row['gender']=="Male") {
				echo '<select class="form-control" name="gender" required>
						<option selected value="Male">Male</option>
						<option value="Female">Female</option>
					</select>';
			}
			else
			{
				echo '<select class="form-control" name="gender" required>
						<option value="Male">Male</option>
						<option selected value="Female">Female</option>
					</select>';
			}
			
			echo '</div>
			</div>
			<div class="col-sm-12">
				<br/>
			</div>	
			<div class="col-sm-5">
				<div class="input-group">
					<span class="input-group-addon">House No.</span>
					<input type="number" name="house" class="form-control" required value="'.$row['house_no'].'">
				</div>
			</div>
			<div class="col-sm-7">
				<div class="input-group">
					<span class="input-group-addon">Street</span>
					<input type="text" name="street" class="form-control" required value="'.$row['street'].'">
				</div>
			</div>
			<div class="col-sm-12">
				<br/>
			</div>
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">Barangay</span>
					<input type="text" name="barangay" class="form-control" required value="'.$row['barangay'].'">
				</div>
			</div>	
			<div class="col-sm-12">
				<br/>
			</div>
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">City/Municipality</span>
					<input type="text" name="municipality" class="form-control" required value="'.$row['municipality'].'">
				</div>
			</div>
			<div class="col-sm-12">
				<br/>
			</div>	
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">Contact Number</span>
					<input type="number" name="contact_number" class="form-control" required value="'.$row['contact_number'].'">
				</div>
			</div>
			<div class="col-sm-12">
				<br/>
			</div>	
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">Email Address</span>
					<input type="email" name="email" class="form-control" required value="'.$row['email'].'">
				</div>
			</div>
			<div class="col-sm-12">
				<br/>
			</div>	
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">Birthdate</span>
					<input type="date" name="birthdate" class="form-control" required value="'.$row['birthdate'].'">
				</div>
			</div>
			<div class="col-sm-12">
				<br/>
			</div>	
			<div class="col-sm-12">
				<div class="input-group">
				<span class="input-group-addon">Position</span>
				<select class="form-control" name="position" required><option value="'.$row['position'].'">Select Position</option>';
				$query_2="SELECT * FROM tbllists WHERE type='position'";
				$get_2=mysql_query($query_2);
				while ($row_2=mysql_fetch_array($get_2)) {
					echo "<option value='".$row_2['title']."'>".$row_2['title']."</option>";
				}
			echo '</select></div></div>
			<div class="col-sm-12">
				<br/>
			</div>	
			<div class="col-sm-12">
				<div class="input-group">
				<span class="input-group-addon">Department</span>
				<select class="form-control" name="department" required><option value="'.$row['department'].'">Select Department</option>';
				$query_2="SELECT * FROM tbllists WHERE type='department'";
				$get_2=mysql_query($query_2);
				while ($row_2=mysql_fetch_array($get_2)) {
					echo "<option value='".$row_2['title']."'>".$row_2['title']."</option>";
				}
			echo '</select></div></div>
			<div class="col-sm-12">
				<hr/>
			</div>	
			<div class="col-sm-5">
				<div class="input-group">
					<span class="input-group-addon">ID No.</span>
					<input type="text" name="employee_id" class="form-control" required value="'.$row['employee_id'].'" readonly>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="input-group">
					<span class="input-group-addon">Password</span>
					<input type="password" name="pw" class="form-control" required value="'.$row['pw'].'" id="edit_pw" onkeyup="qr_code_generator_edit()">
					<input type="number" value="'.$row['id'].'" name="id" style="display:none;">
				</div>
			</div>
			<div class="col-sm-12">
				<br/>
			</div>
			<div class="col-sm-12">
				<center><h4>QR Code</h4></center>
			</div>
			<div class="col-sm-12">
				<div id="qr_code_edit">
					<center><img src="qr_code_generator.php?value='.$row['pw'].' class="img-responsive" width="50%"></center>
				</div>
			</div>
		</div>';
}
?>