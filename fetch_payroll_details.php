<?php
$id=$_POST['id'];
$output="";
include('connection.php');

$query="SELECT * FROM tblpayroll WHERE id='$id'";
$get=mysql_query($query);
$row=mysql_fetch_array($get);

$output.='<div id=print_payroll><center><table width="50%" id="gross_salary">
							<tr>
								<td colspan="2"><center><h5>Date Range :<h5></center></td>
							</tr>
							<tr>
								<td colspan="2">Start:<input type="date" id="date_from" style="border:0px;" name="from_date" value="'.$row['from_date'].'" readonly><input type="text" id="date_from" style="border:0px;display:none;" name="id" value="'.$id.'" readonly></td>
							</tr>
							<tr>
								<td colspan="2">End: <input type="date" id="date_to" style="border:0px;" name="to_date" value="'.$row['to_date'].'" readonly></td>
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
								<td width="35%">&#8369;<input type="text" name="gross_salary" style="border: 0px;" readonly size="7" required value="'.$row['gross'].'"></td>
							</tr>
							<tr>
								<td>Double Pay :</td>
								<td>&#8369;<input type="text" name="double_pay" size="7" style="border: 0px;" readonly required value="'.$row['double_pay'].'"></td>
							</tr>
							<tr>
								<td>Overtime Pay :</td>
								<td>&#8369;<input type="text" name="overtime_pay" size="7" style="border: 0px;" readonly required value="'.$row['overtime'].'"></td>
							</tr>
							<tr>
								<td>Total Gross:</td>
								<td>&#8369;<input type="text" name="total_gross" size="7" style="border: 0px;" readonly required id="total_gross" value="'.$row['total_gross'].'"></td>
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
								<td>&#8369;<input type="text" name="sss" size="7" style="border: 0px;" readonly id="sss_deduction" required value="'.$row['sss'].'"></td>
							</tr>
							<tr>
								<td>PAG-IBIG Funds : </td>
								<td>&#8369;<input type="text" name="pagibig" size="7" style="border: 0px;" readonly id="pagibig_deduction" required value="'.$row['pagibig'].'"></td>
							</tr>
							<tr>
								<td>PHILHEALTH Insurance : </td>
								<td>&#8369;<input type="text" name="philhealth" size="7" style="border: 0px;" readonly id="philhealth_deduction" required value="'.$row['philhealth'].'"></td>
							</tr>
							<tr>
								<td>Other Deductions : </td>
								<td>&#8369;<input type="text" name="other" size="7" style="border: 0px;" readonly id="other_deduction" required value="'.$row['other_deductions'].'"></td>
							</tr>
							<tr>
								<td>Total Deductions : </td>
								<td>&#8369;<input type="text" name="total_deduction" size="7" style="border: 0px;" readonly id="total_deduction" required value="'.$row['total_deductions'].'"></td>
							</tr>
							<tr>
								<td colspan="2"><center>------------------------------------------------------</center></td>
								<td></td>
							</tr>
							<tr>
								<td><h4>Total Net Salary : <h4></td>
								<td>&#8369;<input type="text" name="total_net" size="7" style="border: 0px;" readonly style="font-size: 44pt;" required id="total_net" value="'.$row['total_net'].'"></td>
							</tr>
						</table></center></div>';
mysql_close();
echo $output;;
?>