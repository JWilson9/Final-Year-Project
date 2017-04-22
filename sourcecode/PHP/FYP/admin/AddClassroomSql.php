<?php

$con=mysqli_connect("localhost","root","","fyp");
//check connection

$classroom = $_POST['classroom'];
$totalStudents = $_POST['tStudents'];
$studentGroup = $_POST['sGroup'];

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

//check to see if all fields are entered
if (empty($classroom) || empty($totalStudents) || empty($studentGroup) ){
	die('complete all fields');
}
if($num_rows > 0)
{	
	die('fail');
}

else{

	mysqli_query($con,"INSERT INTO classroom (RoomName, TotalStudents, StudGroup ) VALUES('$_POST[classroom]', '$_POST[tStudents]', '$_POST[sGroup]')");
}

header("location:addClass.php");


mysqli_close($con);


?>




