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


	$classId = mysql_real_escape_string($_GET['classId']);
	$result = mysqli_query($con,"SELECT * FROM class WHERE class_id = '$classId'");
	$row =  mysqli_fetch_array($result);

	$classId = $row['class_id'];
	$classYear = $row['year'];	
	$classGroup = $row['classGroup'];
?>


	<div class="container-fluid" >
	<form action="updateStudentClassSql.php" method="post" >

		Class ID: <br>
		<input type="text" name="classId" value="<?php echo $classId ;?>" required readonly>
		<br>
		Class Year:<br>
		<input type="text" name="classYear" value="<?php echo $classYear;?>" required>
		<br>
		<br>
		Class Group:<br>
		<input type="text" name="classGroup" value="<?php echo $classGroup;?>" required>
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