<?php

$con=mysqli_connect("localhost","root","","fyp");
//check connection

$tName = $_POST['t_name'];

if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysql_connect_error();
}





if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysql_connect_error();
}

//check to see if all fields are entered
if (empty($tName) ){
	die('complete all fields');
}else{

mysqli_query($con,"INSERT INTO Teacher (t_name ) VALUES('$_POST[t_name]')");
}

header("location:teacher.php");


mysqli_close($con);


?>




