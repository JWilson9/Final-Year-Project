<?php
session_start();
if(!isset($_SESSION["email"])){
	header("location:http://localhost/FYP/");
} else {
?>
<?php include '../includes/adminHeader.php';?>

<body>
	<div class="se-pre-con"></div>
	<?php include '../includes/adminNavBar.php';?>

<?php

	$con=mysqli_connect("localhost","root","","fyp");
	//check connection

	if(mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysql_connect_error();
	}


	$roomName = mysql_real_escape_string($_GET['RoomName']);
	$result = mysqli_query($con,"SELECT * FROM classroom WHERE RoomName='$roomName'");
	$row =  mysqli_fetch_array($result);

	$room = $row['RoomName'];
	$totalStudents = $row['TotalStudents'];
	$studentGroup = $row['StudGroup'];	
?>


	<div class="container-fluid" >
	<form action="updateClassroomSql.php" method="post" >

		Room Name: <br>
		<input type="text" name="classroom" value="<?php echo $room ;?>" readonly>
		<br>
		Total Students:<br>
		<input type="text" name="tStudents" value="<?php echo $totalStudents;?>" required>
		<br>
		Student Group:<br>
		<input type="text" name="sGroup" value="<?php echo $studentGroup;?>" required>
		<br>
		<br>
		<button input type="submit" value="update">update</button>
			

	</form>

	</div>




</body>



</html>
<?php
}
?>