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


	  <div class="w3-row-padding" style="float:center;">
	  	<h3> Step 1 - Adding a Student Class </h3>
	  	<p>
	  		To schedule a timetable, the first step to add student classes to your system. You do this by going to the student class page
	  		and adding a student class, you should see the student class on the right when you complete the form
	  	</p>
	  	<h3> Step 2 - Add a teacher</h3>
	  	<p>
	  		The next step is adding a teacher to your system. 
	  	</p>
	  	<h3> Step 3 - Add subjects </h3>
	  	<p>
	  		Once there is a teacher in the system, you are now able to add subjects to the system
	  	</p>
	  	<h3> Step 4 - Add classrooms </h3>
	  	<p>
	  		Once you have done all of the following steps, you are then able to add classrooms to your system, then once all of this 
	  		is completed, you can now schedule your timetable 
	  	</p>
	  </div>



</body>



</html>
<?php
}
?>