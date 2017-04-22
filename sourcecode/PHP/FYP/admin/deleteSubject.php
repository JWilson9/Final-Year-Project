<?php
$connect=mysqli_connect("localhost","root","","fyp");


if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$sid = mysql_real_escape_string($_GET['id']);
mysqli_query($connect,"DELETE FROM subject WHERE id ='$sid'");

header("location:subject.php");
mysqli_close($connect);


?>