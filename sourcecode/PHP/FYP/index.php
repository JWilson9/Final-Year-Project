<?php


if(!empty($_GET['email']))
{
	session_start();
	$connect=mysqli_connect("localhost","root","","fyp");

	if (mysqli_connect_errno())
	{
	 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$email = $_GET['email'];
	$password = $_GET['password'];

	if($email && $password){
		// To protect MySQL injection
		$email = stripslashes($email);
		$password = stripslashes($password);

		$sql="SELECT * FROM admin WHERE email='$email' and password='$password'";
		$result=mysqli_query($connect,$sql);
		// Mysql_num_row is counting table row
		$count=mysqli_num_rows($result);


		if($count==1){
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $password;
			header("location:admin/index.php");
			//redirect to the homepage of the website
		}
		else{
			echo "<p class=\"bg-danger\" style=\"margin:0px; text-align:center;\">Incorrect email or password </p>";
		}//end else
			
	}// end if email and password

}




?>


<!DOCTYPE html>
<html>
<html lang = "en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Smart School</title>
	<link rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
 	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
	<script >$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");
		
	});</script>

	<style>
		body{
			background-image: url("images/photo_bg.jpg");
			background-repeat: no-repeat;
			width:100%;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}	

	</style>
</head>

<body >
<div class="se-pre-con"></div>
	

		<div id="navigation">
			<nav class="navbar navbar-default navbar-static-top" role="navigation">
			  <div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" 
			      data-target="#example-navbar-collapse">
			    <span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    </button>
			    <a class="navbar-brand" href="index.php">SmartSchool</a>
			  </div>
			  <div class="collapse navbar-collapse" id="example-navbar-collapse">
			    <ul class="nav navbar-nav">
			      <li class="active"><a href="index.html">HOME</a></li>
			      <li><a href="contact.php">Contact</a></li>
			    </ul>
			  </div>
			</nav>
		
		<form  action="" role="form" >
			<div class="login-block">

			    <h1>Student/Staff Login</h1>
			    <input type="email" value="" placeholder="email" id="username" name="email" required />
			    <input type="password" value="" placeholder="Password" id="password" name="password" required />
			    <button type="submit" class="btn btn-default">Sign In</button>
			</div>
		</form>



	</div>

	 <nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
      
    </div>
  </nav>


</body>

</html>