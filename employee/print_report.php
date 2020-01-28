<?php
include('../connection.php');
$mode=$_GET['mode'];
$id=$_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		*
		{
			padding: 0px;
			margin: 0px;
			font-family: serif;
		}
	</style>
	<script type="text/javascript">
		function printreport()
		{
	        var printButton = document.getElementById("print_button");
	        printButton.style.visibility = 'hidden';
	        printButton.style.visibility = 'hidden';
	        window.print()
		}
	</script>
</head>
<body>
<div class="container">
	<!--<a href="#" class="pull-right" id="print_button" onclick="printreport();"><h4>Print</h4></a>-->
	<br/>
		<?php
		if ((isset($_POST['from']))&&(isset($_POST['to']))) {
			$from=$_POST['from'];
			$to=$_POST['to'];
			if ($mode=="timein") {
				$query="SELECT * FROM tbltime WHERE time_in BETWEEN '$from' AND '$to' AND ref_id='$id' ORDER BY id DESC ";
			}
			elseif ($mode=="timeout") {
				$query="SELECT * FROM tbltime WHERE time_out BETWEEN '$from' AND '$to' AND ref_id='$id' ORDER BY id DESC ";
			}
			$get=mysql_query($query);
			$count=1;
			while ($row=mysql_fetch_array($get)) {
				$ref_id=$row['ref_id'];
				$query_2="SELECT * FROM tblemployee WHERE id='$ref_id'";
				$get_2=mysql_query($query_2);
				$row_2=mysql_fetch_array($get_2);
				if ($mode=="timein") {
					echo "<table border='2px' width='100%' cellspacing='0' cellpadding='0'><tr><td>".$count."</td><td><center>".date("M jS, Y h:i:s",strtotime($row['time_in']))."</center></td></tr></table>";
				}
				elseif ($mode=="timeout") {
					echo "<table border='2px' width='100%' cellspacing='0' cellpadding='0'><tr><td>".$count."</td><td><center>".date("M jS, Y h:i:s",strtotime($row['time_out']))."</center></td></tr></table>";
				}
				$count++;
			}
		}
		else
		{
			if ($mode=="timein") {
				$query="SELECT * FROM tbltime WHERE ref_id='$id' ORDER BY id DESC ";
			}
			elseif ($mode=="timeout") {
				$query="SELECT * FROM tbltime WHERE ref_id='$id' ORDER BY id DESC ";
			}
			$count=1;
			$get=mysql_query($query);
			while ($row=mysql_fetch_array($get)) {
				$ref_id=$row['ref_id'];
				$query_2="SELECT * FROM tblemployee WHERE id='$ref_id'";
				$get_2=mysql_query($query_2);
				$row_2=mysql_fetch_array($get_2);
				if ($mode=="timein") {
					echo "<table border='2px' width='100%' cellspacing='0' cellpadding='0'><tr><td>".$count."</td><td><center>".date("M jS, Y h:i:s",strtotime($row['time_in']))."</center></td></tr></table>";
				}
				elseif ($mode=="timeout") {
					echo "<table border='2px' width='100%' cellspacing='0' cellpadding='0'><tr><td>".$count."</td><td><center>".date("M jS, Y h:i:s",strtotime($row['time_out']))."</center></td></tr></table>";
				}
				$count++;
			}
		}
		mysql_close();
		//echo  date( 'Y-m-d H:i:s');
		?>
	

</div>
</body>
</html>