<html>
	<!doctype html>
<html lang = "en">

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<title>MySchool</title>
	<link rel="stylesheet">


</head>



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

<button onclick="myFunction()">Click me</button>

<p id="demo"></p>

<script>
function myFunction() {
    <?php if(function_exists('shell_exec')) {
    echo "exec is enabled";
}else{
	echo "failed";
}


 ?>
}
</script>




</html>