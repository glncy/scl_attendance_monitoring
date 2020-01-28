<?php
$title=mysql_real_escape_string(rtrim(ltrim($_POST['title'])));
$desc=mysql_real_escape_string(rtrim(ltrim($_POST['desc'])));
//echo $_POST['title'];
$output="";
include('connection.php');
$query="INSERT INTO tblannounce (title,description) VALUES ('$title','$desc')";
if (mysql_query($query)) {
	$output.='<script type="text/javascript">
				setTimeout(function() {
				    $("#report").fadeOut("slow");
				}, 4000); // <-- time in milliseconds
			</script>
			<div class="col-sm-12" id="report">
						<h6 style="padding: 10px; background-color: green; color: white;">Announcemnt Added.</h6>
					</div>';
	$output.='<label>Title:</label>
	<input type="text" id="title_text" class="form-control">
	<br/>
	<label>Description:</label>
	<textarea class="form-control" rows="10" style="resize: none;" id="description_text"></textarea>';
}
else
{
	$output.='<script type="text/javascript">
				setTimeout(function() {
				    $("#report").fadeOut("slow");
				}, 4000); // <-- time in milliseconds
			</script>
			<h6 style="padding: 10px; background-color: red; color: white;" id="report">Failed to Add Announcemnt.</h6>';
	$output.='<label>Title:</label>
	<input type="text" id="title_text" class="form-control">
	<br/>
	<label>Description:</label>
	<textarea class="form-control" rows="10" style="resize: none;" id="description_text"></textarea>';
}
echo $output;
?>