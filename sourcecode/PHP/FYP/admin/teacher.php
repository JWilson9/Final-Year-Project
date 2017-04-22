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
			
			
		<h1 > Add Teacher</h1>

		<form action="AddTeacherSql.php" method="post"  >
			
			Name:<br>
			<input type="text" name="t_name" required>
			<br>
			<br>
		


			<button type="submit" class="btn btn-primary" value="Submit">Submit</button>

		</form>
	</div>

<div class="container-fluid" style="float: right; width:70%;">
			
	<h1 > List of Teacher's </h1>

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
<th>Name</th>
<th>Delete Teacher</th>
<th>Update Teacher</th>
</tr>";


$result = mysqli_query($con, "SELECT * FROM Teacher");
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['t_name'] . "</td>";
  echo('<td><a href="deleteTeacher.php?id='.htmlentities($row[0]).'">Delete Teacher</a></td>');
  echo('<td><a href="updateTeacher.php?id='.htmlentities($row[0]).'">Update Teacher</a></td>');
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