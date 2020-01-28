<?php

$value=$_GET['value'];
include('assets/phpqrcode/qrlib.php');

// outputs image directly into browser, as PNG stream 
QRcode::png($value);
?>