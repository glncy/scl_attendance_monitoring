<?php
$from = $_POST['from'];
$to = $_POST['to'];
$id = $_POST['id'];
$start = "";
$end = "";
$result = 0;
$overtime = 0;
$double_pay = 0;
include('connection.php');

$query = "SELECT * FROM tbltime WHERE time_in_date BETWEEN '$from' AND '$to' AND ref_id='$id' ORDER BY time_in_date ASC LIMIT 1";
$get=mysql_query($query) or die(mysql_error());
$row=mysql_fetch_array($get);
$start = $row['time_in_date'];

$query = "SELECT * FROM tbltime WHERE time_in_date BETWEEN '$from' AND '$to' AND ref_id='$id' ORDER BY time_in_date DESC LIMIT 1";
$get=mysql_query($query) or die(mysql_error());
$row=mysql_fetch_array($get);
$end=$row['time_in_date'];

$query = "SELECT * FROM tbltime WHERE time_in_date BETWEEN '$from' AND '$to' AND ref_id='$id' ORDER BY time_in_date ASC";
$get=mysql_query($query) or die(mysql_error());

while ($row=mysql_fetch_array($get))
{
	$from_time=$row['time_in_time'];
	$to_time=$row['time_out_time'];
	$from_time=date("H:i:s",strtotime($from_time));
	$to_time=date("H:i:s",strtotime($to_time));
	$total = strtotime($to_time) - strtotime($from_time);
	$hours = (int)($total/60/60);
	$query_2 = "SELECT * FROM tblholidays WHERE holidays='$from'";
	$get_2=mysql_query($query_2);
	$num_rows = mysql_num_rows($get_2);
	if ($num_rows>0) {
		$double_pay += $hours;
	}
	if ($hours>4) {
		$overtime = $hours - 4;
		$result += $hours - $overtime;
	}
	else
	{
		$result+=$hours;
	}
}
$query = "SELECT * FROM tbllists WHERE type='rate'";
$get = mysql_query($query);
$row = mysql_fetch_array($get);
$result *= $row['title'];
$overtime *= $row['title'];
$double_pay *= $row['title'];
echo '
	<tr>
		<td colspan="2"><center><h5>Date Range :<h5></center></td>
	</tr>
	<tr>
		<td colspan="2">Start:<input type="date" id="date_from" style="border:0px;" name="from_date" value="'.$start.'" readonly></td>
	</tr>
	<tr>
		<td colspan="2">End: <input type="date" id="date_to" style="border:0px;" name="to_date" value="'.$end.'" readonly></td>
	</tr>
	<tr>
		<td colspan="2"><center>------------------------------------------------------</center></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="2"><center><h5>Salary<h5></center></td>
	</tr>
	<tr>
		<td width="65%">Gross Salary:</td>
		<td width="35%">&#8369;<input type="text" name="gross_salary" style="border: 0px;" readonly size="7" required value="'.$result.'"></td>
	</tr>
	<tr>
		<td>Overtime Pay :</td>
		<td>&#8369;<input type="text" name="overtime_pay" size="7" style="border: 0px;" readonly required value="'.$overtime.'"></td>
	</tr>
	<tr>
		<td>Double Pay :</td>
		<td>&#8369;<input type="text" name="double_pay" size="7" style="border: 0px;" readonly required value="'.$double_pay.'"></td>
	</tr>
	<tr>
		<td>Total Gross:</td>
		<td>&#8369;<input type="text" name="total_gross" size="7" style="border: 0px;" readonly required value="'.($result+$overtime+$double_pay).'" id="total_gross"></td>
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
	</tr>';
?>