<?php
include('../connection.php');
$employee_id=mysql_real_escape_string(rtrim(ltrim($_POST['employee_id'])));
$mode=$_GET['mode'];
$query="SELECT * FROM tblemployee WHERE employee_id='$employee_id'";
$get=mysql_query($query);
$num_rows=mysql_num_rows($get);
$row=mysql_fetch_array($get);
$id=$row['id'];
$query="SELECT * FROM tbltime WHERE ref_id='$id' ORDER BY id DESC LIMIT 1";
$get=mysql_query($query);
$num_rows_2=mysql_num_rows($get);
$row2=mysql_fetch_array($get);
if ($mode=="timein") {
	if (($row2['time_in_date']!="")&&($row2['time_out_date']!="")||($num_rows_2==0))
	{
		if ($num_rows>0)
		{
			/*echo '<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon">Password</span>
							<input type="text" name="pw" class="form-control" required>
						</div>
					</div>';*/
			echo '<script type="text/javascript">
			load();
			var pw = "'.$row['pw'].'";
			</script>';
			echo '<div class="modal-body"><div class="row"><div class="col-sm-12"><input type="text" value="'.$row['id'].'" id="id" style="display:none;"><center><h6>Please Scan QR CODE</h6></center></div><div class="col-sm-12">';
			include('qr_scanner.php');
			echo '</div></div></div>';
		}
		else
		{
			echo '<div class="modal-body"><div class="row">
			<script type="text/javascript">
				setTimeout(function() {
				    $("#report").fadeOut("slow");
				}, 4000); // <-- time in milliseconds
			</script>
			<div class="col-sm-12" id="report">
						<h6 style="padding: 10px; background-color: red; color: white;">Invalid Employee ID.</h6>
					</div>
				<div class="col-sm-12">
					<div class="input-group">
						<span class="input-group-addon">Employee ID</span>
						<input type="text" name="employee_id" class="form-control" required id="employee_id">
					</div>
				</div></div></div><div class="modal-footer"><input type="button" name="timein" value="Next" class="btn btn-success" onclick="verify_id();"></div>';
		}
	}
	else
	{

		echo "<script type='text/javascript'>
		alert('Already Timed In!');
		window.location.href = 'index.php';
		</script>";
	}
}
elseif ($mode=="timeout") {
	if ($row2['time_out_date']=="")
	{
		if ($num_rows>0)
		{
			/*echo '<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon">Password</span>
							<input type="text" name="pw" class="form-control" required>
						</div>
					</div>';*/
			echo '<script type="text/javascript">
			load();
			var pw = "'.$row['pw'].'";
			</script>';
			echo '<div class="modal-body"><div class="row"><div class="col-sm-12"><input type="text" value="'.$row2['id'].'" id="timeid" style="display:none;"><input type="text" value="'.$id.'" id="reference" style="display:none;"><center><h6>Please Scan QR CODE</h6></center></div><div class="col-sm-12">';
			include('qr_scanner.php');
			echo '</div></div></div>';
		}
		else
		{
			echo '<div class="modal-body"><div class="row">
			<script type="text/javascript">
				setTimeout(function() {
				    $("#report").fadeOut("slow");
				}, 4000); // <-- time in milliseconds
			</script>
			<div class="col-sm-12" id="report">
						<h6 style="padding: 10px; background-color: red; color: white;">Invalid Employee ID.</h6>
					</div>
				<div class="col-sm-12">
					<div class="input-group">
						<span class="input-group-addon">Employee ID</span>
						<input type="text" name="employee_id" class="form-control" required id="employee_id">
					</div>
				</div></div></div><div class="modal-footer"><input type="button" name="timein" value="Next" class="btn btn-success" onclick="verify_id();"></div>';
		}
	}
	else
	{
		echo "<script type='text/javascript'>
		alert('Already Timed Out!');
		window.location.href = 'index.php';
		</script>";
	}
}
elseif ($mode=="login") {
	if ($num_rows>0)
	{
		/*echo '<div class="col-sm-12">
					<div class="input-group">
						<span class="input-group-addon">Password</span>
						<input type="text" name="pw" class="form-control" required>
					</div>
				</div>';*/
		echo '<script type="text/javascript">
		load();
		var pw = "'.$row['pw'].'";
		</script>';
		echo '<div class="modal-body"><div class="row"><div class="col-sm-12"><input type="text" value="'.$id.'" id="id" style="display:none;"><center><h6>Please Scan QR CODE</h6></center></div><div class="col-sm-12">';
		include('qr_scanner.php');
		echo '</div></div></div>';
	}
	else
	{
		echo '<div class="modal-body"><div class="row">
		<script type="text/javascript">
			setTimeout(function() {
			    $("#report").fadeOut("slow");
			}, 4000); // <-- time in milliseconds
		</script>
		<div class="col-sm-12" id="report">
					<h6 style="padding: 10px; background-color: red; color: white;">Invalid Employee ID.</h6>
				</div>
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">Employee ID</span>
					<input type="text" name="employee_id" class="form-control" required id="employee_id">
				</div>
			</div></div></div><div class="modal-footer"><input type="button" name="timein" value="Next" class="btn btn-success" onclick="verify_id();"></div>';
	}
}
?>