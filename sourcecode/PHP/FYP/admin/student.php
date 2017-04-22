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

	<div class="container-fluid" style="width:300px; float:left; " >
			
			
		<h1 > Add Student</h1>

		<form action="AddStudentSql.php" method="post"  >
			
			Student Name:<br>
			<input type="text" name="sName" required >
			<br><br>
			Student Email<br>
			<input type="text" name="studentEmail" required>
			<br><br>
			Student Year:<br>
			<input type="text" name="year" required>
			<br><br>
			Student Class Group:<br>
			<input type="text" name="classGroup" required>
			<br><br>
			Student Address:<br>
			<input type="text" name="studentAddress" required>
			<br><br>

			<button type="submit" class="btn btn-primary" value="Submit">Submit</button>

		</form>
	</div>

	<div class="container-fluid" style="float right; width:400px;">
				
		<h1 > List of Students </h1>

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
	<th>Student Name</th>
	<th>Student Email Students</th>
	<th>Student Year</th>
	<th>Student Class Group</th>
	<th>Student Student Address</th>
	</tr>";


	$result = mysqli_query($con, "SELECT * FROM students");
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['sName'] . "</td>";
	  echo "<td>" . $row['studentEmail'] . "</td>";
	  echo "<td>" . $row['year'] . "</td>";
	  echo "<td>" . $row['classGroup'] . "</td>";
	  echo "<td>" . $row['studentAddress'] . "</td>";
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