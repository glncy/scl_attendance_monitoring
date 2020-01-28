<?php

session_start();

include('connection.php');

$profile_picture=uploadimage();
$fname=mysql_real_escape_string($_POST['fname']);
$mname=mysql_real_escape_string($_POST['mname']);
$lname=mysql_real_escape_string($_POST['lname']);
$gender=mysql_real_escape_string($_POST['gender']);
$house=mysql_real_escape_string($_POST['house']);
$street=mysql_real_escape_string($_POST['street']);
$barangay=mysql_real_escape_string($_POST['barangay']);
$municipality=mysql_real_escape_string($_POST['municipality']);
$contact_number=mysql_real_escape_string($_POST['contact_number']);
$email=mysql_real_escape_string($_POST['email']);
$birthdate=mysql_real_escape_string($_POST['birthdate']);
$position=mysql_real_escape_string($_POST['position']);
$status=mysql_real_escape_string($_POST['status']);
$department=mysql_real_escape_string($_POST['department']);
$employee_id=mysql_real_escape_string($_POST['employee_id']);
$pw=mysql_real_escape_string($_POST['pw']);

$query="INSERT INTO tblemployee (picture,fname,mname,lname,gender,house_no,street,barangay,municipality,contact_number,email,birthdate,position,department,employee_id,pw) VALUES ('$profile_picture','$fname','$mname','$lname','$gender','$house','$street','$barangay','$municipality','$contact_number','$email','$birthdate','$position','$department','$employee_id','$pw')";

if (mysql_query($query) or die(mysql_error()))
{
	$_SESSION['notification']="SUCCESS";
	$_SESSION['msg']="Employee Added.";
	mysql_close();
	header("Location: employees.php");
}
else
{
	$_SESSION['notification']="FAILED";
	$_SESSION['msg']="Failed tp Add Employee.";
	mysql_close();
	header("Location: employees.php");
}

function uploadimage()
{
	$ext = file_extension($_FILES['pic']['name']) ; 
	$random_filename = date("Y-m-d").time().".".$ext;
	$target_dir = "res/profile_pictures/";
	$target_file = $target_dir . $random_filename;
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Check file size
	if ($_FILES["pic"]["size"] > 500000) {
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $uploadOk = 0;
	}

	if($uploadOk=0)
	{
		echo "<script>alert('There was an Error in Uploading File. Maybe filename is existing or not a valid file');</script>";
		return "FAILED";
	}
	// if everything is ok, try to upload file
	 else {
	    $picture=$random_filename;
	    if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file))
	    {
	        echo "<script>alert('The photo has been uploaded')</script>";
	        return $picture;
	    }
	    else
	    {
	        echo "<script>alert('There was an error uploading the file.')</script>";
	        return "FAILED";
	    }
	}
}

function file_extension($filename)
{
	$filename = strtolower($filename) ; 
	$exts = split("[/\\.]", $filename) ; 
 	$n = count($exts)-1; 
 	$exts = $exts[$n]; 
 	return $exts; 
}
?>
