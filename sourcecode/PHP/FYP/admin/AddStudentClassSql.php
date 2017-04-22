<?php

$con=mysqli_connect("localhost","root","","fyp");
//check connection

$classYear = $_POST['classYear'];
$classGroup = $_POST['classGroup'];

if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysql_connect_error();
}


//$test = mysql_query("SELECT * FROM classroom where 'RoomName' = '$classroom'");
//$num_rows = mysql_num_rows($test);

if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysql_connect_error();
}




else{

	mysqli_query($con,"INSERT INTO class (year, classGroup) VALUES('$_POST[classYear]', '$_POST[classGroup]')");
}

header("location:studentclass.php");


mysqli_close($con);


?>




