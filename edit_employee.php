<?php
session_start();
include('connection.php');
$id=$_POST['id'];
$query="SELECT * FROM tblemployee WHERE id='$id'";
$get=mysql_query($query);
$row=mysql_fetch_array($get);
$profile_picture="";
$picture_delete=$row['picture'];

if ($_FILES['pic']['name']!="")
{
	$profile_picture=uploadimage();
}
echo $_POST['employee_id'];
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
$department=mysql_real_escape_string($_POST['department']);
$employee_id=mysql_real_escape_string($_POST['employee_id']);
$pw=mysql_real_escape_string($_POST['pw']);

if ($profile_picture!="")
{
	$query="UPDATE tblemployee SET fname='$fname',lname='$lname',mname='$mname',gender='$gender',house_no='$house',street='$street',barangay='$barangay',municipality='$municipality',contact_number='$contact_number',email='$email',birthdate='$birthdate',position='$position',department='$department',employee_id='$employee_id',pw='$pw',picture='$profile_picture' WHERE id ='$id'";
}
else
{
	$query="UPDATE tblemployee SET fname='$fname',lname='$lname',mname='$mname',gender='$gender',house_no='$house',street='$street',barangay='$barangay',municipality='$municipality',contact_number='$contact_number',email='$email',birthdate='$birthdate',position='$position',department='$department',employee_id='$employee_id',pw='$pw' WHERE id ='$id'";
}

if (mysql_query($query) or die(mysql_error())) {
	if ($profile_picture!="")
	{
		unlink("res/profile_pictures/".$picture_delete);
	}
	$_SESSION['notification']="SUCCESS";
	$_SESSION['msg']="Employee Updated.";
	mysql_close();
	echo $employee_id.$pw;
	header("Location: employees.php");
}
else
{
	unlink("res/profile_pictures/".$profile_picture);
	$_SESSION['notification']="FAILED";
	$_SESSION['msg']="Failed to Update Employee.";
	mysql_close();
	header("Location: employees.php");
}

if ($_FILES['pic']['error'] !== UPLOAD_ERR_OK) {
   die("Upload failed with error code " . $_FILES['pic']['error']);
}

function uploadimage()
{
	$ext = file_extension($_FILES['pic']['name']) ; 
	$random_filename = date("Y-m-d").time().".".$ext;
	$target_dir = "res/profile_pictures/";
	$target_file = $target_dir . $random_filename;
	$uploadOk = 1;
	/*$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

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
	}*/
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

function file_extension($filename)
{
	$filename = strtolower($filename) ; 
	$exts = split("[/\\.]", $filename) ; 
 	$n = count($exts)-1; 
 	$exts = $exts[$n]; 
 	return $exts; 
}
?>