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


	<div class="container-fluid" style="width:25%; float:left; " >
			
			
		<h1 > Add Classroom</h1>

		<form action="AddClassroomSql.php" method="post"  >
			
			<span ><img src="../images/info.png" style="width:15px;height:15px;" title="Give a name to the classroom you wish to add" required>Classroom</span>
			<br>
			<input type="text" name="classroom">
			<br>
			<br>
			<span ><img src="../images/info.png" style="width:15px;height:15px;" title="Enter in the number of students for this class" required> Total Number Of students</span>
			<input type="text" name="tStudents">
			<br>
			<br>
			<span ><img src="../images/info.png" style="width:15px;height:15px;" title="nter in the student group for this room" required> Student Group</span>
			<?php 
			$con=mysqli_connect("localhost","root","","fyp");
			if(mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysql_connect_error();
			}


			$query = mysqli_query($con,"SELECT * FROM studentclass");

			echo '<select name="sGroup">'; // Open your drop down box
			// Loop through the query results, outputing the options one by one
			while ($row = mysqli_fetch_array($query)) {
			   echo '<option value="'.$row['classId'].'">'.$row['classId'].'</option>';
			}

			echo '</select>';// Close your drop down box
			?>

			<br>
			<br>
			<button type="submit" class="btn btn-primary" value="Submit">Submit</button>

		</form>
	</div>

	<div class="container-fluid" style="float: right; width:70%;">
				
		<h1 > List of Classes </h1>

		<?php

	$con=mysqli_connect("localhost","root","","fyp");
	//check connection

	if(mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysql_connect_error();
	}




	echo "<table class='table table-hover>'";
	echo "
	<tr>
	<th>Classroom</th>
	<th>Total Students</th>
	<th>Level</th>
	<th>Delete Classroom</th>
	<th>Update Classroom</th>
	<th>View Schedule for classroom</th>
	</tr>";


	$result = mysqli_query($con, "SELECT * FROM classroom ORDER BY classroom.StudGroup ");
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['RoomName'] . "</td>";
	  echo "<td>" . $row['TotalStudents'] . "</td>";
	  echo "<td>" . $row['StudGroup'] . "</td>";
	  echo('<td><a href="deleteClass.php?RoomName='.htmlentities($row[0]).'">Delete Classroom</a></td>');
	  echo('<td><a href="updateClassroom.php?RoomName='.htmlentities($row[0]).'">Update Classroom</a></td>');
	  echo('<td><a href="viewSchedule.php?RoomName='.htmlentities($row[0]).'">View Classroom schedule</a></td>');
	  echo "</tr>";
	  }
	  


	 echo "</table>";

	?>

	</div>
</body>



</html>
<?php
}
?>