<?php
include("header.php");
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h1>Reports</h1>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<form action="print_report.php?mode=timein" target="timein_print" method="post">
				<div class="col-sm-6" style="border-right: 2px solid black;">
					<div class="row">
						<div class="col-sm-12">
							<center><h4>Time In Reports</h4></center>
						</div>
						<div class="col-sm-1">
						</div>
						<div class="col-sm-4">
							<label>From:</label>
							<input type="date" name="from" class="form-control">
						</div>
						<div class="col-sm-4">
							<label>To:</label>
							<input type="date" name="to" class="form-control">
						</div>
						<div class="col-sm-2">
							<label></label>
							<input type="submit" value="Search" class="btn btn-success" style="margin-top: 5px;">
						</div>
						<div class="col-sm-12">
							<br/>
						</div>
						<div class="col-sm-12">
							<iframe src="print_report.php?mode=timein" name="timein_print" height="600px" width="100%"></iframe>
						</div>
					</div>
				</div>
				</form>
				<form action="print_report.php?mode=timeout" target="timeout_print" method="post">
				<div class="col-sm-6" style="border-left: 2px solid black;">
					<div class="row">
						<div class="col-sm-12">
							<center><h4>Time Out Reports</h4></center>
						</div>
						<div class="col-sm-1">
						</div>
						<div class="col-sm-4">
							<label>From:</label>
							<input type="date" name="from" class="form-control">
						</div>
						<div class="col-sm-4">
							<label>To:</label>
							<input type="date" name="to" class="form-control">
						</div>
						<div class="col-sm-2">
							<label></label>
							<input type="submit" value="Search" class="btn btn-success" style="margin-top: 5px;">
						</div>
						<div class="col-sm-12">
							<br/>
						</div>
						<div class="col-sm-12">
							<iframe src="print_report.php?mode=timeout" name="timeout_print" height="600px" width="100%"></iframe>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
include("footer.php");
?>