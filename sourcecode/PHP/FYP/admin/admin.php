<html>
	<!doctype html>
<html lang = "en">

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<title>MySchool</title>
	<link rel="stylesheet">
</head>

	<?php include '../includes/adminNavBar.php';?>

	<div class="container-fluid" style="width:300px; float:left; " >
			
			
		<h1 > Add Teacher</h1>

		<form action="AddTeacherSql.php" method="post"  >
			
			Name:<br>
			<input type="text" name="t_name" >
			<br>
			<br>
			Subject<br>
			<input type="text" name="subject" >
			<br><br>


			<button type="submit" class="btn btn-primary" value="Submit">Submit</button>

		</form>
	</div>

<div class="container-fluid" style="float right; width:400px;">
			
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
<th>Subject</th>
<th>Delete Teacher</th>
</tr>";


$result = mysqli_query($con, "SELECT * FROM Teacher");
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['t_name'] . "</td>";
  echo('<td><a href="deleteTeacher.php?id='.htmlentities($row[0]).'">Delete Teacher</a></td>');
  echo "</tr>";
  }
  


 echo "</table>";

?>

</div>



</html>