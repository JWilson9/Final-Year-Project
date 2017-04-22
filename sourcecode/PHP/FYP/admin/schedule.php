<!DOCTYPE html>
<html>
<html lang = "en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	
	<title>Smart School</title>
	<link rel="stylesheet">
</head>


<form action="execSchedule.php" method="get">
  <button type="submit" class="btn btn-success">Schedule Timetable</button>
</form>



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
<th>Room</th>
<th>TimeSlot</th>
<th>Day</th>
<th>subject</th>
<th>teacher</th>
<th>Student Year</th>
</tr>";


$result = mysqli_query($con, "SELECT * FROM timetable");
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['roomName'] . "</td>";
  echo "<td>" . $row['timeslot'] . "</td>";
  echo "<td>" . $row['day'] . "</td>";
  echo "<td>" . $row['subject'] . "</td>";
  echo "<td>" . $row['teacherName'] . "</td>";
  echo "<td>" . $row['studentGroup'] . "</td>";
  echo "</tr>";
  }
  


 echo "</table>";

?>


</html>
