<?php
session_start();
if (!isset($_SESSION['user_admin'])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>San Carlos Lumber and Hardware Inc.</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap3/css/bootstrap-theme.min.css">
	<script type="text/javascript" src="assets/jquery3.2.min.js"></script>
	<script type="text/javascript" src="assets/highcharts.js"></script>
	<script type="text/javascript" src="assets/exporting.js"></script>
	<script type="text/javascript" src="assets/bootstrap3/js/bootstrap.min.js"></script>
	<style type="text/css">
		.navbar-property
		{
			background-color: #808080;
			border-radius: 0px;
		}
		.navbar-property>a
		{
			color: white;
		}
		.navbar-property>div>ul>li>a
		{
			color: white;
		}
		.navbar-property>div>ul>li>a:hover
		{
			color: black;
		}
	</style>
	<script type="text/javascript">
	function reset()
	{
		var choice=confirm('Reset The System?');
		if (choice==true) {
			window.location.href = "reset.php";
		}
		else
		{
			alert('Cancelled.');
		}
	}
	<?php
	if ($location=="index") {
		echo "window.onload = setInterval(clock,1000);";
	}
	?>

	function fetch_payroll_details(id)
	{
		$.ajax({
				type: 'post',
				url: 'fetch_payroll_details.php',
				data: {
					id:id,
				},
				success: function (response) {
				$( '#payroll_details' ).html(response);
				}
			});
	}

	function del_payroll(id,ref_id)
	{
		$.ajax({
				type: 'post',
				url: 'del_payroll.php',
				data: {
					id:id,ref_id:ref_id,
				},
				success: function (response) {
				$( '#view_payroll_result' ).html(response);
				}
			});
	}

	function transfer_value(id)
	{
		var values = document.getElementById(id).value;
		if (id=='sss') {
			document.getElementById('sss_deduction').value = values;
		}
		else if (id=='philhealth') {
			document.getElementById('philhealth_deduction').value = values;
		}
		else if (id=='pagibig') {
			document.getElementById('pagibig_deduction').value = values;
		}
		else if (id=='other') {
			document.getElementById('other_deduction').value = values;
		}

		var sss = parseFloat(document.getElementById('sss_deduction').value);
		var pagibig = parseFloat(document.getElementById('pagibig_deduction').value);
		var philhealth = parseFloat(document.getElementById('philhealth_deduction').value);
		var other = parseFloat(document.getElementById('other_deduction').value);
		var result = sss+pagibig+philhealth+other;

		if (!isNaN(result))
		{
			document.getElementById('total_deduction').value = result;
			var total_gross = document.getElementById('total_gross').value;
			document.getElementById('total_net').value = total_gross - result;

		}
		else
		{
			document.getElementById('total_deduction').value = "";
		}
	}

    function clock()
    {
		var d = new Date();

		var date = d.getDate();

		var month = d.getMonth();
		var montharr =["Jan","Feb","Mar","April","May","June","July","Aug","Sep","Oct","Nov","Dec"];
		month=montharr[month];

		var year = d.getFullYear();

		var day = d.getDay();
		var dayarr =["Sun","Mon","Tues","Wed","Thurs","Fri","Sat"];
		day=dayarr[day];

		var hour =d.getHours();
		var min = d.getMinutes();
		var sec = d.getSeconds();

		min = (min < 10 ? "0" : "") + min;
		sec = (sec < 10 ? "0" : "") + sec;
		var apm = (hour < 12) ? "am" : "pm";
		hour = (hour > 12) ? hour - 12 : hour;
		hour = (hour == 0) ? 12 : hour;
		var ctime = hour + ":" + min + ":" + sec + " " + apm;

		document.getElementById("date").innerHTML=day+" "+date+" "+month+" "+year;
		document.getElementById("time").innerHTML=ctime;
    }
  	</script>
	<script type="text/javascript">
		setTimeout(function() {
		    $('#notif').fadeOut('slow');
		}, 4000); // <-- time in milliseconds
	</script>
	<script type="text/javascript">
		<?php
		if ($location=="index") {
			echo "fetch_notification();
		setInterval(function(){
			fetch_notification();
			del_announce();
		},1000);";

		}
		elseif ($location=="settings") {
			echo "setInterval(interval_positions,2000);";
		}
		?>

		function interval_positions()
		{
			$.ajax({
				type: 'post',
				url: 'interval.php',
				data: {
					type:'position',
				},
				success: function (response) {
				$( '#position_list' ).html(response);
				}
			});
			$.ajax({
				type: 'post',
				url: 'interval.php',
				data: {
					type:'department',
				},
				success: function (response) {
				$( '#department_list' ).html(response);
				}
			});
			$.ajax({
				type: 'post',
				url: 'interval.php',
				data: {
					type:'holiday',
				},
				success: function (response) {
				$( '#holiday_list' ).html(response);
				}
			});
		}

		function fetch_notification(){
			$.ajax({
				url: 'fetch_timed.php',
				success: function (response) {
				$( '#timed' ).html(response);
				}
			});
		}

		function fetch_payroll(id){
			$.ajax({
				type: 'post',
				url: 'fetch_payroll.php',
				data: {
					id:id,
				},
				success: function (response) {
				$( '#view_payroll_result' ).html(response);
				}
			});
		}

		function update_rph(){
			var rph = document.getElementById('rate_per_hour').value;
			$.ajax({
				type: 'post',
				url: 'update_rph.php',
				data: {
					rph:rph,
				},
				success: function (response) {
				$( '#report' ).html(response);
				}
			});
		}

		function add_list(type)
		{
			if (type=="position") {
				var title=document.getElementById('txtPosition').value;
				$.ajax({
					type: 'post',
					url: 'add_list.php',
					data: {
						title:title,type:type,
					},
					success: function (response) {
					$( '#position_modal' ).html(response);
					}
				});
			}
			else if (type=="department")
			{
				var title=document.getElementById('txtDepartment').value;
				$.ajax({
					type: 'post',
					url: 'add_list.php',
					data: {
						title:title,type:type,
					},
					success: function (response) {
					$( '#department_modal' ).html(response);
					}
				});
			}
			else if (type=="holiday")
			{
				var title=document.getElementById('txtHoliday').value;
				$.ajax({
					type: 'post',
					url: 'add_list.php',
					data: {
						title:title,type:type,
					},
					success: function (response) {
					$( '#holiday_modal' ).html(response);
					}
				});
			}
			else if (type=="admin")
			{
				var user=document.getElementById('user').value;
				var pw=document.getElementById('pw').value;
				$.ajax({
					type: 'post',
					url: 'add_list.php',
					data: {
						user:user,pw:pw,type:type,
					},
					success: function (response) {
					$( '#admin_list' ).html(response);
					}
				});
			}
		}
		function del_list(id,type)
		{
			var choice = confirm('Delete?');
			if (choice == true) {
				if (type=="position") {
					$.ajax({
						type: 'post',
						url: 'delete_list.php',
						data: {
							id:id,type:type,
						},
						success: function (response) {
						$( '#position_list' ).html(response);
						}
					});
				}
				else if (type=="department")
				{
					$.ajax({
						type: 'post',
						url: 'delete_list.php',
						data: {
							id:id,type:type,
						},
						success: function (response) {
						$( '#department_list' ).html(response);
						}
					});
				}
				else if (type=="holiday")
				{
					$.ajax({
						type: 'post',
						url: 'delete_list.php',
						data: {
							id:id,type:type,
						},
						success: function (response) {
						$( '#holiday_list' ).html(response);
						}
					});
				}
				else if (type=="admin")
				{
					$.ajax({
						type: 'post',
						url: 'delete_list.php',
						data: {
							id:id,type:type,
						},
						success: function (response) {
						$( '#admin_list' ).html(response);
						}
					});
				}
			}
			else
			{
				alert('Cancelled');
			}
		}

		function delButton(id,name) {
			var choice = confirm('Confirm Delete : '+name+'?');
			if (choice == true) {
			    window.location.href = 'del_employee.php?id='+id;
			} else {
			    alert("Cancelled.");
			}
		}
		function photo_select()
		{
			var a = document.getElementById('photo').value;
			document.getElementById('img_src').src=a;
		}

		function select_month_graph(id)
		{
			var month=document.getElementById('month_select').value;
			$.ajax({
				type: 'post',
				url: 'chart.php',
				data: {
					id:id,change:'',month:month,
				},
				success: function (response) {
				$( '#change_chart' ).html(response);
				}
			});
		}

		function fetch_details(id,mode)
		{
			if (mode=='view')
			{
				$.ajax({
					type: 'post',
					url: 'fetch_details.php',
					data: {
						id:id,mode:mode,
					},
					success: function (response) {
					$( '#view_details' ).html(response);
					}
				});

				$.ajax({
					type: 'post',
					url: 'chart.php',
					data: {
						id:id,
					},
					success: function (response) {
					$( '#employee_chart' ).html(response);
					}
				});
			}
			else if (mode=='edit')
			{
				$.ajax({
					type: 'post',
					url: 'fetch_details.php',
					data: {
						id:id,mode:mode,
					},
					success: function (response) {
					$( '#edit_details' ).html(response);
					}
				});
			}
		}

		function del_announce(id)
		{
			$.ajax({
				type: 'post',
				url: 'del_announce.php',
				data: {
					id:id,
				},
				success: function (response) {
				$( '#announce' ).html(response);
				}
			});
		}

		function edit_admin(id)
		{
			$.ajax({
				type: 'post',
				url: 'fetch_admin.php',
				data: {
					id:id,
				},
				success: function (response) {
				$( '#edit_modal' ).html(response);
				}
			});
		}

		function transfer_id(id)
		{
			document.getElementById('ref_id').value = id;
			document.getElementById('ref_id_2').value = id;
		}

		function fetch_salary()
		{
			var from=document.getElementById('from_salary').value;
			var to=document.getElementById('to_salary').value;
			var id=document.getElementById('ref_id').value;
			$.ajax({
				type: 'post',
				url: 'salary.php',
				data: {
					from:from,to:to,id:id,
				},
				success: function (response) {
				$( '#gross_salary' ).html(response);
				}
			});

			document.getElementById('date_to').value=to;
			document.getElementById('date_from').value=from;
		}

		function add_announce()
		{
			var title = document.getElementById('title_text').value;
			var description = document.getElementById('description_text').value;
			//alert(title);
			$.ajax({
				type: 'post',
				url: 'add_announce.php',
				data: {
					title:title,desc:description,
				},
				success: function (response) {
				$( '#add_announce' ).html(response);
				}
			});
		}

		function qr_code_generator()
		{
			var pw=document.getElementById('pw').value;
			$.ajax({
				type: 'post',
				url: 'qr_pw.php',
				data: {
					pw:pw,
				},
				success: function (response) {
				$( '#qr_code' ).html(response);
				}
			});
		}

		function qr_code_generator_edit()
		{
			var pw=document.getElementById('edit_pw').value;
			$.ajax({
				type: 'post',
				url: 'qr_pw.php',
				data: {
					pw:pw,
				},
				success: function (response) {
				$( '#qr_code_edit' ).html(response);
				}
			});
		}
		function addId()
		{
			var d = new Date();
			var id= "SCL-"+d.getDate()+""+d.getMilliseconds()+""+d.getMonth()+""+d.getDay();
			document.getElementById('employee_id').value = id;
		}

		/*function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#blah').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});*/

		function PreviewImage() {
	        var oFReader = new FileReader();
	        oFReader.readAsDataURL(document.getElementById("photo").files[0]);

	        oFReader.onload = function (oFREvent) {
	            document.getElementById("img_src").src = oFREvent.target.result;
	        };
	    };

	    function PreviewImage_edit() {
	        var oFReader = new FileReader();
	        oFReader.readAsDataURL(document.getElementById("photo_edit").files[0]);

	        oFReader.onload = function (oFREvent) {
	            document.getElementById("img_src_edit").src = oFREvent.target.result;
	        };
	    };
	</script>
	<script>
		$(document).ready(function(e){
			$('#search').keyup(function(){
					$('#result').show('');
					var txt = $(this).val();
					$.ajax({
						url:"fetch_search.php",
						method:"GET",
						data:'search='+txt,
						success:function(data)
						{
							$('#result').html(data);
						}
					});
				});
			});
	</script>
	<script>
		$(document).ready(function(e){
			$('#search_payroll').keyup(function(){
					$('#result_payroll').show('');
					var txt = $(this).val();
					$.ajax({
						url:"fetch_search_payroll.php",
						method:"GET",
						data:'search='+txt,
						success:function(data)
						{
							$('#result_payroll').html(data);
						}
					});
				});
			});
	</script>
</head>
<body>
<nav class="navbar navbar-light bg-faded navbar-property" style="margin-bottom: 0px;">
	<a href="" class="navbar-brand">San Carlos Lumber and Hardware Inc.</a>
</nav>
<nav class="navbar navbar-light bg-faded navbar-property" style="margin-top: ">
	<div class="container-fluid">
		<ul class="nav navbar-nav"> 
			<li class="nav-item active"><a href="index.php" class="nav-link"><span class="glyphicon glyphicon-home"></span>&nbspHome<span class="sr-only">(current)</span></a></li>
			<li class="nav-item"><a href="employees.php" class="nav-link"><span class="glyphicon glyphicon-user"></span>&nbspEmployees</a></li>
			<li class="nav-item"><a href="reports.php" class="nav-link"><span class="glyphicon glyphicon-file"></span>&nbspReports</a></li>
			<li class="nav-item"><a href="payroll.php" class="nav-link"><span class="glyphicon glyphicon-list-alt"></span>&nbspPayroll</a></li>
			<li class="nav-item"><a href="settings.php" class="nav-link"><span class="glyphicon glyphicon-cog"></span>&nbspSettings</a></li>
			<!--<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Employees<span class="caret"></span></a>
    			<ul class="dropdown-menu">
      				<li><a href="#">List</a></li>
     				<li><a href="#">Page 1-2</a></li>
    				<li><a href="#">Page 1-3</a></li>
    			</ul>
      		</li>-->
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="nav-item"><a href="logout.php" class="nav-link"><span class="glyphicon glyphicon-log-out"></span>&nbspLog Out</a></li>
		</ul>
	</div>
</nav>