<?php
include('connection.php');
$mode=$_GET['mode'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="assets/jquery3.2.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap3/js/bootstrap.min.js"></script>
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
	<br/>
	<button hclass="pull-right" id="print_button" onclick="printreport();" style="float:right;"><h4>Print</h4></button>
	<br/>
	<br/>

	<hr color="black" style="border-color:black; " />
	<center><h4>SAN CARLOS LUMBER ATTENDANCE MONITORING</h4></center>
	<hr color="black" style="border-color:black; " />
	<center><h6><?php 
	if ($mode=="timein")
	{
		echo "TIME IN";
	}
	elseif ($mode=="timeout")
	{
		echo "TIME OUT";
	}
	?>
		
	</h6></center>
	<center><h6>FROM: <?php if (isset($_POST['from']))
	{
		echo date("m-d-Y", strtotime($_POST['from']));
	} 
	else 
	{ 
		echo "----------";
	}
	?> | TO: <?php 
	if(isset($_POST['to']))
	{
		echo date("m-d-Y", strtotime($_POST['to']));
	} 
	else 
	{ 
		echo "----------";
	}?></h6></center>
	<table border="2px" width="100%" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<td width="50%"><center>Name</center></td>
				<td width="50%"><center>Date and Time</center></td>
			</tr>
		</thead>
		<?php
		if ((isset($_POST['from']))&&(isset($_POST['to']))) {
			$from=$_POST['from'];
			$to=$_POST['to'];
			if ($mode=="timein") {
				$query="SElECT * FROM tbltime WHERE time_in_date BETWEEN '$from' AND '$to' ORDER BY id DESC ";
			}
			elseif ($mode=="timeout") {
				$query="SElECT * FROM tbltime WHERE time_out_date BETWEEN '$from' AND '$to' ORDER BY id DESC ";
			}
			$get=mysql_query($query);
			while ($row=mysql_fetch_array($get)) {
				$ref_id=$row['ref_id'];
				$query_2="SElECT * FROM tblemployee WHERE id='$ref_id'";
				$get_2=mysql_query($query_2);
				$row_2=mysql_fetch_array($get_2);
				if ($mode=="timein") {
					echo "<tr><td>".$row_2['fname']." ".$row_2['lname']."</td><td>".date("M jS, Y",strtotime($row['time_in_date']))." ".date("h:i A",strtotime($row['time_in_time']))."</td></tr>";
				}
				elseif ($mode=="timeout") {
					echo "<tr><td>".$row_2['fname']." ".$row_2['lname']."</td><td>".date("M jS, Y",strtotime($row['time_out_date']))." ".date("h:i A",strtotime($row['time_out_time']))."</td></tr>";
				}
				
			}
		}
		mysql_close();
		//echo  date( 'Y-m-d H:i:s');
		?>
	</table>

</div>
</body>
</html>