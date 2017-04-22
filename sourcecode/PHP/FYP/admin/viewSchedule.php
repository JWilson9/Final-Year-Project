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


	echo "<table class='table table-hover>'";
	echo "
	<tr>
	<th>Classroom</th>
	<th>Time Schedule </th>
	<th>Day</th>
	<th>Subject</th>
	<th>Class Group</th>
	<th>Teacher Name</th>
	</tr>";


	$result = mysqli_query($con, "SELECT timetable.roomName, timetable.timeslot, timetable.day, timetable.subject, 
	timetable.studentGroup, teacher.t_name FROM timetable 
	JOIN teacher on teacher.id = timetable.teacherName 
	WHERE timetable.roomName = '$roomName' ORDER BY timetable.day");
	while($row = mysqli_fetch_array($result))
	  {
	   	  echo "<tr>";
		  echo "<td>" . $row['roomName'] . "</td>";
		  echo "<td>" . $row['timeslot'] . "</td>";
		  echo "<td>" . $row['day'] . "</td>";
		  echo "<td>" . $row['subject'] . "</td>";
		  echo "<td>" . $row['studentGroup'] . "</td>";
		  echo "<td>" . $row['t_name'] . "</td>";
		  echo "</tr>";
	  }
	  


	 echo "</table>";

	?>
<?php
}
?>
