<?php
$connect=mysqli_connect("localhost","root","","fyp");


if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$classId = mysql_real_escape_string($_GET['classId']);
mysqli_query($connect,"DELETE FROM class WHERE class_id ='$classId'");

header("location:studentClass.php");
mysqli_close($connect);


?>