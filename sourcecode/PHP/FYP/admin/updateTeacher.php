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


	$tid = mysql_real_escape_string($_GET['id']);
	$result = mysqli_query($con,"SELECT * FROM teacher WHERE id='$tid'");
	$row =  mysqli_fetch_array($result);

	$tid = $row['id'];
	$teacherName = $row['t_name'];	

?>


	<div class="container-fluid" >
	<form action="updateTeacherSql.php" method="post" >

		Teacher ID <br>
		<input type="text" name="tid" value="<?php echo $tid ;?>" readonly>
		<br>
		Teacher Name <br>
		<input type="text" name="teacherName" value="<?php echo $teacherName ;?>" required>
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