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


	$sid = mysql_real_escape_string($_GET['id']);
	$result = mysqli_query($con,"SELECT * FROM subject WHERE id='$sid'");
	$row =  mysqli_fetch_array($result);

	$sid = $row['id'];
	$subjectName = $row['name'];
	$noHours = $row['no_hours'];	
	$className = $row['class_name'];
	$teacherId = $row['teacherId'];

?>


	<div class="container-fluid" >
	<form action="updateSubjectSql.php" method="post" >

		Subject ID <br>
		<input type="text" name="sid" value="<?php echo $sid ;?>" readonly>
		<br>
		Subject Name <br>
		<input type="text" name="subjectName" value="<?php echo $subjectName ;?>" required>
		<br>
		Number Of Hours<br>
		<input type="text" name="noHours" value="<?php echo $noHours;?>" required>
		<br>
		Class Name:
		<?php 
			$con=mysqli_connect("localhost","root","","fyp");
			if(mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysql_connect_error();
			}


			$query = mysqli_query($con,"SELECT * FROM studentclass");

			echo '<select name="className">'; // Open your drop down box
			// Loop through the query results, outputing the options one by one
			while ($row = mysqli_fetch_array($query)) {
			   echo '<option value="'.$row['classId'].'">'.$row['classId'].'</option>';
			}

			echo '</select>';// Close your drop down box
			?>
			<br>
			<br>
			<span > Teacher ID:</span>
			<?php 
			$con=mysqli_connect("localhost","root","","fyp");
			if(mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysql_connect_error();
			}


			$query = mysqli_query($con,"SELECT * FROM teacher");

			echo '<select name="teacherId">'; // Open your drop down box
			// Loop through the query results, outputing the options one by one
			while ($row = mysqli_fetch_array($query)) {
			   echo '<option value="'.$row['id'].'" >'.$row['id']." ".$row['t_name'].'</option><br>';
			}

			echo '</select>';// Close your drop down box
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
		<button input type="submit" value="update">update</button>
			

	</form>

	</div>




</body>



</html>
<?php
}
?>