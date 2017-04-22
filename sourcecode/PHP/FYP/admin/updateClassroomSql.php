<?php

$con=mysqli_connect("localhost", "root", "", "fyp");

//check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}

//mysqli_query($con,"UPDATE dvd SET  Title='$_POST[Title]',Date_of_Release='$_POST[Date_of_Release]',In_Stock='$_POST[In_Stock]' WHERE DVD_Id = '$_POST[userID]'");
mysqli_query($con,"UPDATE classroom SET  TotalStudents='$_POST[tStudents]', StudGroup='$_POST[sGroup]' WHERE RoomName = '$_POST[classroom]'");

header("location:addClass.php");


mysqli_close($con);
?>


