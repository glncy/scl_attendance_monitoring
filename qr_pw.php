<?php
$pw=$_POST['pw'];
if ($pw!='') {
	echo "<center><img src='qr_code_generator.php?value=".$pw."' class='img-responsive' width='50%'></center>";
}
else{
	echo "";
}
?>