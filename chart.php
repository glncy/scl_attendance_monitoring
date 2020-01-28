<?php
if (isset($_POST['month'])) {
    $date_month=$_POST['month'];
}
else
{
    $date_month=date('m');   
}
$ref_id=$_POST['id'];

if ($date_month=="1") {
    $month = "January";
}
elseif ($date_month=="2") {
    $month = "February";
}
elseif ($date_month=="3") {
    $month = "March";
}
elseif ($date_month=="4") {
    $month = "April";
}
elseif ($date_month=="5") {
    $month = "May";
}
elseif ($date_month=="6") {
    $month = "June";
}
elseif ($date_month=="7") {
    $month = "July";
}
elseif ($date_month=="8") {
    $month = "August";
}
elseif ($date_month=="9") {
    $month = "September";
}
elseif ($date_month=="10") {
    $month = "October";
}
elseif ($date_month=="11") {
    $month = "November";
}
elseif ($date_month=="12") {
    $month = "December";
}

?>

<script type="text/javascript">
$(function () {
        var seriesData=[
        <?php
        include('connection.php');
        $day=1;
        $year=date('Y');
        $output="";
        $days=cal_days_in_month(CAL_GREGORIAN, $date_month, $year);
        while ( $day<= $days) {
            $result=0;
            $current_date=date('Y-m-d',strtotime($year."-".$date_month."-".$day));
            $query="SELECT * FROM tbltime WHERE time_in_date='$current_date' AND time_out_date='$current_date' AND ref_id='$ref_id'";
            $get=mysql_query($query) or die(mysql_error());
            $num_rows=mysql_num_rows($get);
            if ($num_rows>0) {
                while ($row=mysql_fetch_array($get))
                {
                    $from_time=$row['time_in_time'];
                    $to_time=$row['time_out_time'];
                    $from_time=date("H:i:s",strtotime($from_time));
                    $to_time=date("H:i:s",strtotime($to_time));
                    $total = strtotime($to_time) - strtotime($from_time);
                    $hours = (int)($total/60/60);
                    $result+=$hours;
                }
                if ($day==$days) {
                    $output .="['".$day."',".$result."]";
                }
                else
                {
                    $output .="['".$day."',".$result."],";
                }
            }
            else
            {
                if ($day==$days) {
                    $output .="['".$day."',".$result."]";
                }
                else
                {
                    $output .="['".$day."',".$result."],";
                }
            }
            $day++;
        }
        echo $output;
        mysql_close();
        ?>];
        $('#chart').highcharts({
            chart: {

            },
            title: {
                text: '<?php echo $month;?>'
            },
            yAxis: {
                title: {
                    text: 'Hours'
                }
            },
            exporting: { enabled: false },
            subtitle: {
                text: ''
            },
            xAxis: {
                title: {
                    text: 'Days'
                },
                tickInterval: 1,
                labels: {
                    enabled: true,
                    formatter: function() { return seriesData[this.value][0];},
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                showInLegend: false,name: 'Work',data: seriesData     
            }]
        });
    });
</script>
<?php
    if (isset($_POST['change'])) {
        echo '<div id="chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>';
    }
    else
    {
        echo '<div class="col-sm-4"></div>
        <div class="col-sm-4">
        <select class="form-control" id="month_select" onchange="select_month_graph('.$ref_id.')">';

        include('connection.php');
        $month=1;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='1'>January</option>";
        }
        $month=2;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='2'>February</option>";
        }
        $month=3;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='3'>March</option>";
        }
        $month=4;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='4'>April</option>";
        }
        $month=5;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='5'>May</option>";
        }
        $month=6;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='6'>June</option>";
        }
        $month=7;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='7'>July</option>";
        }
        $month=8;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='8'>August</option>";
        }
        $month=9;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='9'>September</option>";
        }
        $month=10;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='10'>October</option>";
        }
        $month=11;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='11'>November</option>";
        }
        $month=12;
        $query="SELECT * FROM tbltime WHERE MONTH(time_in_date)='$month' AND ref_id='$ref_id'";
        $get=mysql_query($query);
        if (mysql_num_rows($get)>0) {
            echo "<option value='12'>December</option>";
        }
        echo '</select>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-12"><hr/></div><div class="col-sm-12" id="change_chart"><div id="chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div></div>';
    }
    
?>
