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
			
			
		<h1 > Add Student Year/ Class</h1>

		<form action="AddStudentClassSql.php" method="post"  >
			
			<span ><img src="../images/info.png" style="width:15px;height:15px;" title="Enter in the student year" required>Student Year</span>
			<br>
			<input type="text" name="classYear">
			<br>
			<br>
			<span ><img src="../images/info.png" style="width:15px;height:15px;" title="Enter in the student group" required> Student Group</span><BR>
			<input type="text" name="classGroup">
			<br>
			<br>
			
			<button type="submit" class="btn btn-primary" value="Submit">Submit</button>

		</form>
	</div>

	<div class="container-fluid" style="float: right; width:70%;">
				
		<h1 > List of Student Classes </h1>

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
	<th>Class Year</th>
	<th>Class Group</th>
	<th>Delete Class</th>
	<th>Update Class</th>
	</tr>";


	$result = mysqli_query($con, "SELECT * FROM class ");
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['year'] . "</td>";
	  echo "<td>" . $row['classGroup'] . "</td>";
	  echo('<td><a href="deleteStudentClass.php?classId='.htmlentities($row[0]).'">Delete Class </a></td>');
	  echo('<td><a href="updateStudentClass.php?classId='.htmlentities($row[0]).'">Update Class</a></td>');
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