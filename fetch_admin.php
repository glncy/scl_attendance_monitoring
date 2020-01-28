<?php
$id=$_POST['id'];
$output="";
include('connection.php');

$query="SELECT * FROM tbladmin WHERE id='$id'";
$get=mysql_query($query) or die(mysql_error());
$row=mysql_fetch_array($get);

$output.='<div class="row">
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">Username</span>
					<input type="text" name="user" class="form-control" required value="'.$row['user'].'">
				</div>
				<input type="text" name="id" class="form-control" required value="'.$row['id'].'" style="display:none;">
			</div>
			<div class="col-sm-12">
				<br/>
			</div>
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">Password</span>
					<input type="password" name="pw" class="form-control" required value="'.$row['pw'].'">
				</div>
			</div>
		</div>';

echo $output;
?>