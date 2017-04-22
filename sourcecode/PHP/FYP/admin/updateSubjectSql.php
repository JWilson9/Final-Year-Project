<?php

$con=mysqli_connect("localhost", "root", "", "fyp");

//check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}

//mysqli_query($con,"UPDATE dvd SET  Title='$_POST[Title]',Date_of_Release='$_POST[Date_of_Release]',In_Stock='$_POST[In_Stock]' WHERE DVD_Id = '$_POST[userID]'");
mysqli_query($con,"UPDATE subject SET  name='$_POST[subjectName]', no_hours='$_POST[noHours]', class_name='$_POST[className]', teacherId='$_POST[teacherId]', level='$_POST[sLevel]' WHERE id = '$_POST[sid]'");

header("location:subject.php");


mysqli_close($con);
?>


