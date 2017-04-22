<?php

$con=mysqli_connect("localhost", "root", "", "fyp");

//check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}

//mysqli_query($con,"UPDATE dvd SET  Title='$_POST[Title]',Date_of_Release='$_POST[Date_of_Release]',In_Stock='$_POST[In_Stock]' WHERE DVD_Id = '$_POST[userID]'");
mysqli_query($con,"UPDATE class SET  year='$_POST[classYear]', classGroup='$_POST[classGroup]' WHERE class_id = '$_POST[classId]'");

header("location:studentClass.php");


mysqli_close($con);
?>


