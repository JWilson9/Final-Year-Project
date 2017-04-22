<?php

$con=mysqli_connect("localhost","root","","fyp");
//check connection

$sName = $_POST['sName'];
$noHours = $_POST['noHours'];
$className = $_POST['className'];
$teacherId = $_POST['teacherId'];
$sLevel = $_POST['sLevel'];

if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysql_connect_error();
}





if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysql_connect_error();
}


$test = (int)$noHours;

if($test > 30){
	echo "fail";
}


//check to see if all fields are entered
//if (empty($sName) || empty($noHours) || empty($className) || empty($teacherId)  ){
	//die('complete all fields');
//}else{

mysqli_query($con,"INSERT INTO subject (name, no_hours, class_name, teacherId, level ) VALUES('$_POST[sName]', '$_POST[noHours]', '$_POST[className]', '$_POST[teacherId]', '$_POST[sLevel]')");
//}

header("location:subject.php");


mysqli_close($con);


?>




