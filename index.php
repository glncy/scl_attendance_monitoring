<?php
$location="index";
include("header.php");
?>

<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-5">
							<h4>Notifications</h4>
						</div>
					</div>
				</div>
				<div class="panel-body" style="overflow-y:scroll; height:450px;">
					<div class="row" id="timed">
						
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-4">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-5">
							<h4>Announcement</h4>
						</div>
						<div class="col-sm-1">
						</div>
						<div class="col-sm-6 pull-right">
							<input type="button" class="form-control btn btn-warning" value="Add Annoucement" data-toggle="modal" data-target="#addAnnoucement">
						</div>
					</div>
				</div>
				<div class="panel-body" style="overflow-y:scroll; height:450px;">
					<div class="row" id="announce">
						<?php
						include('connection.php');
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
									<div class='col-sm-12'><a href='#' class='pull-right' onclick='del_announce(".$row['id'].");'>Delete Annoucement</a>
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

		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-12">
							<center><h4>Today is : </h4></center>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<center><h1 id="date"></h1></center>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-12">
							<center><h4>Time is : </h4></center>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<center><h1 id="time"></h1></center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addAnnoucement" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Add Announcement</h4>
			</div>
			<!--<form class="form-group" enctype="multipart/form-data" method="POST">-->
				<div class="modal-body" id="add_announce">
					<label>Title:</label>
					<input type="text" id="title_text" class="form-control">
					<br/>
					<label>Description:</label>
					<textarea class="form-control" rows="10" style="resize: none;" id="description_text"></textarea>
				</div>
				<div class="modal-footer">
					<input type="button" value="Submit" class="btn btn-warning" onclick="add_announce();">
				</div>
			<!--</form>-->
		</div>
	</div>
</div>
<?php
include("footer.php");
?>