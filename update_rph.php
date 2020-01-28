<?php
$rph=$_POST['rph'];
include('connection.php');

$query="UPDATE tbllists SET title='$rph' WHERE type='rate'";
if (mysql_query($query)) {
	echo "<script>setTimeout(function() {
		    $('#message').fadeOut('slow');
		}, 4000); // <-- time in milliseconds</script>
		<div class='col-sm-12' id='message'><h6 style='padding:10px;color:white;background-color:green;'>Rate Per Hour Updated!</h6></div>";
}
mysql_close();
?>