<?php
$connect=mysqli_connect("localhost","root","","fyp");


if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$RoomName = mysql_real_escape_string($_GET['RoomName']);
mysqli_query($connect,"DELETE FROM classroom WHERE RoomName ='$RoomName'");

header("location:addClass.php");
mysqli_close($connect);


?>