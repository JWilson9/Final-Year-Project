<?php

$con=mysqli_connect("localhost","root","","fyp");
//check connection

$tName = $_POST['t_name'];
$tSubject = $_POST['subject'];

if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysql_connect_error();
}





if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysql_connect_error();
}

//check to see if all fields are entered
if (empty($tName) || empty($tSubject) ){
	die('complete all fields');
}else{

mysqli_query($con,"INSERT INTO Teacher (t_name, subject ) VALUES('$_POST[subject]')");
}

//header("location:AddCustomers.php");


mysqli_close($con);


?>




