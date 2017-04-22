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

	<div class="container-fluid" style="width:20%; float:left; " >
			
			
		<h1 > Add Subject</h1>

		<form action="AddSubjectSql.php" method="post"  >
			
			<span ><img src="../images/info.png" style="width:15px;height:15px;" title="Give a name to the subject you wish to add" required> Subject Name</span>
			<input type="text" name="sName" required>
			<br>
			<br>
			<span ><img src="../images/info.png" style="width:15px;height:15px;" title="Allocate the number of hours per week for this subject" required> Number of classes per week</span>
			
			 <input type="number" name="noHours" min="1" max="10"><br>
			<br>
			<span ><img src="../images/info.png" style="width:15px;height:15px;" title="Name of the class" required> Class Name:</span>
		
			<?php 
			$con=mysqli_connect("localhost","root","","fyp");
			if(mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysql_connect_error();
			}


			$query = mysqli_query($con,"SELECT * FROM class");

			echo '<select name="className">'; // Open your drop down box
			// Loop through the query results, outputing the options one by one
			while ($row = mysqli_fetch_array($query)) {
			   echo '<option value="'.$row['classGroup'].'">'.$row['classGroup'].'</option>';
			}

			echo '</select>';// Close your drop down box
			?>
			<br>
			<br>
			<span ><img src="../images/info.png" style="width:15px;height:15px;" title="ID of the teacher (see teacher table)" required> Teacher ID:</span>
			<?php 
			$con=mysqli_connect("localhost","root","","fyp");
			if(mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysql_connect_error();
			}


			$query = mysqli_query($con,"SELECT * FROM teacher");

			echo '<select name="teacherId">'; 
			// Loop through the query results, outputing the options one by one
			while ($row = mysqli_fetch_array($query)) {
			   echo '<option value="'.$row['id'].'" >'.$row['id']." ".$row['t_name'].'</option>';
			}

			echo '</select>';// 
			?>
			<br>
			<br>
			<span ><img src="../images/info.png" style="width:15px;height:15px;" title="Name of the class" required> Subject Level:</span>
			<select name="sLevel">
			  <option value="Ordinary">Ordinary</option>
			  <option value="Higher">Higher</option>
			</select>
			<br>
			<br>

			<button type="submit" class="btn btn-primary" value="Submit">Submit</button>

		</form>
	</div>
	

	<div class="container-fluid" style="float: right; width:70%;">
				
	<h1 > List of Subjects </h1>

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
	<th>Subject Name</th>
	<th>Number of Classes</th>
	<th>class Name</th>
	<th>Teacher ID</th>
	<th>Level</th>
	<th>Delete Subject</th>
	<th>Update Subject</th>
	</tr>";


	$result = mysqli_query($con, "SELECT * FROM subject ORDER BY subject.class_name ASC");
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['name'] . "</td>";
	  echo "<td>" . $row['no_hours'] . "</td>";
	  echo "<td>" . $row['class_name'] . "</td>";
	  echo "<td>" . $row['teacherId'] . "</td>";
	  echo "<td>" . $row['level'] . "</td>";
	  echo('<td><a href="deleteSubject.php?id='.htmlentities($row[0]).'">Delete Subject</a></td>');
	  echo('<td><a href="updateSubject.php?id='.htmlentities($row[0]).'">Update Subject</a></td>');
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