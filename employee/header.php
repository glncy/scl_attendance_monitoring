<?php
date_default_timezone_set("Asia/Manila");
session_start();

$_SESSION['id']="";
$_SESSION['mode']="";
if ((isset($_SESSION['user_id']))&&(isset($_SESSION['pw']))) {
	header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>San Carlos Lumber and Hardware Inc.</title>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap3/css/bootstrap-theme.min.css">
	<script type="text/javascript" src="../assets/jquery3.2.min.js"></script>
	<script type="text/javascript" src="../assets/bootstrap3/js/bootstrap.min.js"></script>

<script type="text/javascript" src="qr_js/grid.js"></script>
<script type="text/javascript" src="qr_js/version.js"></script>
<script type="text/javascript" src="qr_js/detector.js"></script>
<script type="text/javascript" src="qr_js/formatinf.js"></script>
<script type="text/javascript" src="qr_js/errorlevel.js"></script>
<script type="text/javascript" src="qr_js/bitmat.js"></script>
<script type="text/javascript" src="qr_js/datablock.js"></script>
<script type="text/javascript" src="qr_js/bmparser.js"></script>
<script type="text/javascript" src="qr_js/datamask.js"></script>
<script type="text/javascript" src="qr_js/rsdecoder.js"></script>
<script type="text/javascript" src="qr_js/gf256poly.js"></script>
<script type="text/javascript" src="qr_js/gf256.js"></script>
<script type="text/javascript" src="qr_js/decoder.js"></script>
<script type="text/javascript" src="qr_js/qrcode.js"></script>
<script type="text/javascript" src="qr_js/findpat.js"></script>
<script type="text/javascript" src="qr_js/alignpat.js"></script>
<script type="text/javascript" src="qr_js/databr.js"></script>
<script type="text/javascript" src="qr_js/scanner.js"></script>

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
	

	<?php
	if ($location=="index") {
		echo "window.onload = setInterval(function(){
    	clock();
    	announce();
    },1000);";
	}
	?>
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
		}, 8000); // <-- time in milliseconds
	</script>
	<script type="text/javascript">
		var modetime="";
		function method(mode)
		{
			modetime=mode;
		}
		function delButton(id,name) {
			var choice = confirm('Confirm Delete : '+name+'?');
			if (choice == true) {
			    window.location.href = 'del_employee.php?id='+id;
			} else {
			    alert("Cancelled.");
			}
		}

		function announce()
		{
			$.ajax({
				url: 'announce.php',
				success: function (response) {
				$( '#announce' ).html(response);
				}
			});
		}

		function photo_select()
		{
			var a = document.getElementById('photo').value;
			document.getElementById('img_src').src=a;
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
				   // We get the element having id of display_info and put the response inside it
					$( '#view_details' ).html(response);
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
				   // We get the element having id of display_info and put the response inside it
					$( '#edit_details' ).html(response);
					}
				});
			}
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
			   // We get the element having id of display_info and put the response inside it
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
			   // We get the element having id of display_info and put the response inside it
				$( '#qr_code_edit' ).html(response);
				}
			});
		}

		function verify_id()
		{
			var employee_id=document.getElementById('employee_id').value;
			$.ajax({
				type: 'post',
				url: 'verify_employee_id.php?mode=timein',
				data: {
					employee_id:employee_id,
				},
				success: function (response) {
			   // We get the element having id of display_info and put the response inside it
				$( '#verify' ).html(response);
				}
			});
		}

		function verify_id_2()
		{
			var employee_id=document.getElementById('employee_id_2').value;
			$.ajax({
				type: 'post',
				url: 'verify_employee_id.php?mode=timeout',
				data: {
					employee_id:employee_id,
				},
				success: function (response) {
			   // We get the element having id of display_info and put the response inside it
				$( '#verify_2' ).html(response);
				}
			});
		}

		function verify_id_3()
		{
			var employee_id=document.getElementById('employee_id_3').value;
			$.ajax({
				type: 'post',
				url: 'verify_employee_id.php?mode=login',
				data: {
					employee_id:employee_id,
				},
				success: function (response) {
			   // We get the element having id of display_info and put the response inside it
				$( '#verify_3' ).html(response);
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
</head>
<body>
<nav class="navbar navbar-light bg-faded navbar-property" style="margin-bottom: 0px;">
	<a href="" class="navbar-brand">San Carlos Lumber and Hardware Inc.</a>
</nav>
<?php
echo '<nav class="navbar navbar-light bg-faded navbar-property" style="margin-top: ">
	<div class="container-fluid">
		<ul class="nav navbar-nav navbar-left"> 
			<li class="nav-item active"><a href="" class="nav-link" data-toggle=\'modal\' data-target=\'#timein\' onclick="method(\'timein\')"><span class="glyphicon glyphicon-log-in"></span>&nbspTime In<span class="sr-only">(current)</span></a></li>
			<li class="nav-item"><a href="" class="nav-link" data-toggle=\'modal\' data-target=\'#timeout\' onclick="method(\'timeout\')"><span class="glyphicon glyphicon-log-out"></span>&nbspTime Out</a></li>
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
			<li class="nav-item"><a href="" class="nav-link" data-toggle=\'modal\' data-target=\'#login\' onclick="method(\'login\')"><span class="glyphicon glyphicon-log-in"></span>&nbspLog in</a></li>
		</ul>
	</div>
</nav>';
?>