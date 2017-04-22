<?php
$connect=mysqli_connect("localhost","root","","fyp");


if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$id = mysql_real_escape_string($_GET['id']);
mysqli_query($connect,"DELETE FROM Teacher WHERE id ='$id'");

header("location:teacher.php");
mysqli_close($connect);


?>