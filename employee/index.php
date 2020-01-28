<?php
$location="index";
include("header.php");
?>
<div class="container">
	<div class="row">
		<div class="col-sm-7">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<center><h1 id="date"></h1></center>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<center><h1 id="time"></h1></center>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<hr style="border: 2px black solid;" />
						</div>
					</div>
					<div class="row" id="notif">
					<?php
					if (($_SESSION['id']!="")&&($_SESSION['mode']!=""))
					{
						$ref_id=mysql_real_escape_string($_SESSION['id']);
						include('../connection.php');
						$datetime = date('m-d-y H:i:s');
						$query="SELECT * FROM tblemployee WHERE id='$ref_id'";
						$result=mysql_query($query);
						$row=mysql_fetch_array($result);
						/*echo "<script type='text/javascript'>
		setTimeout(function() {
		    $('#notif').fadeOut('slow');
		}, 10000); // <-- time in milliseconds
	</script>";*/
						//echo "<div class='col-sm-12'><center><h3>Timed In at ".$datetime."</h3></center></div>";
						//echo "<div class='col-sm-12'><hr style='border: 2px black solid;' /></div>";
						echo "<div class='col-sm-4'><img src='../res/profile_pictures/".$row['picture']."' class='img-responsive'></div>";
						echo "<div class='col-sm-6'><h4>Name : ".$row['fname']." ".$row['mname']." ".$row['lname']."</h4></div>";
						echo "<div class='col-sm-6'><h4>Employee ID : ".$row['employee_id']."</h4></div>";
						echo "<div class='col-sm-6'><h4>Position : ".$row['position']."</h4></div>";
						echo "<div class='col-sm-6'><h4>Department : ".$row['department']."</h4></div>";
						if ($_SESSION['mode']=='timein')
						{
							echo "<div class='col-sm-6'><h4>Timed In at ".$datetime."</h4></div>";
						}
						elseif ($_SESSION['mode']=='timeout')
						{
							echo "<div class='col-sm-6'><h4>Timed out at ".$datetime."</h4></div>";
						}
						$_SESSION['id']="";
						$_SESSION['mode']="";
					}
					?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-5">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-5">
							<h4>Announcements</h4>
						</div>
					</div>
				</div>
				<div class="panel-body" style="overflow-y:scroll; height:440px;">
					<div class="row" id="announce">
						<?php
						include('../connection.php');
						$query="SELECT * FROM tblannounce";
						$get=mysql_query($query) or die(mysql_error());
						if (mysql_num_rows($get)!=0) {
							while ($row=mysql_fetch_array($get)) {
								echo "<div class='col-sm-12' style='border: 2px solid rgba(100, 101, 102,0.2); border-radius: 10px;'>
								<div class='row'>
									<div class='col-sm-12'>
									<h4>".$row['title']."</h4>
									</div>
									<div class='col-sm-12'>
									<h6>".$row['description']."</h6>
									</div>
								</div>
								</div>";
							}
							mysql_close();
						}
						else
						{
							mysql_close();
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="timein" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Time In</h4>
			</div>
			<div id="verify">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon">Employee ID</span>
							<input type="text" class="form-control" required id="employee_id">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="button" name="timein" value="Next" class="btn btn-success" onclick="verify_id();">
			</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="timeout" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Time Out</h4>
			</div>
			<div id="verify_2">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon">Employee ID</span>
							<input type="text" class="form-control" required id="employee_id_2">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="button" name="timein" value="Next" class="btn btn-success" onclick="verify_id_2();">
			</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="login" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Login</h4>
			</div>
			<div id="verify_3">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon">Employee ID</span>
							<input type="text" class="form-control" required id="employee_id_3">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="button" name="timein" value="Next" class="btn btn-success" onclick="verify_id_3();">
			</div>
			</div>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>