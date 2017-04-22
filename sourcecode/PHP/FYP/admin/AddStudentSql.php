<?php

$con=mysqli_connect("localhost","root","","fyp");
//check connection

$sName = $_POST['sName'];
$sEmail = $_POST['studentEmail'];
$year = $_POST['year'];
$classGroup = $_POST['classGroup'];
$studentAddress = $_POST['studentAddress'];


if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysql_connect_error();
}





if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysql_connect_error();
}

//check to see if all fields are entered
if (empty($sName) || empty($sEmail) || empty($year) || empty($classGroup) || empty($studentAddress) ){
	die('complete all fields');
}else{

mysqli_query($con,"INSERT INTO students (sName, studentEmail, year, classGroup, studentAddress ) VALUES('$_POST[sName]', '$_POST[studentEmail]', '$_POST[year]', '$_POST[classGroup]', '$_POST[studentAddress]')");
}

header("location:student.php");


mysqli_close($con);


?>