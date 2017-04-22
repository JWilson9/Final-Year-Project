<?php
session_start();

$connect=mysqli_connect("localhost","root","","fyp");

if (mysqli_connect_errno())
{
 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$aEmail = $_POST['email'];
$password=$_POST['password']; 

if($aEmail && $password){
	// To protect MySQL injection
	$aEmail = stripslashes($aEmail);
	$password = stripslashes($password);

	/*$checkAdmin="SELECT * FROM admin WHERE email like '$aEmail'";
	$resultAdmin=mysqli_query($connect,$checkAdmin);
	$countAdmin=mysqli_num_rows($resultAdmin);*/

		//if($countAdmin==1){
			$sql="SELECT * FROM admin WHERE email='$aEmail' and password='$password'";
			$result=mysqli_query($connect,$sql);
			// Mysql_num_row is counting table row
			$count=mysqli_num_rows($result);

		// If result matched $myusername and $mypassword, table row must be 1 row
			if($count==1){
				// Register $username, $password and redirect to file "login_success.php"
				$_SESSION['email'] = $aEmail;
				$_SESSION['password'] = $password;
				//$_SESSION['post-data'] = $_POST;
				
				header("location:admin/index.php");
				//redirect to the homepage of the website
		
			}// end if count == 1
			else{
				// have to give feedback to the user
				header("location:index.php");	
				//echo "<p class=\"bg-danger\" style=\"margin:0px; text-align:center;\">email or password Incorrect! </p>";	
				//include 'index.php';
			}//end else
			
		//}


	}// end if email and password
	else{
		echo "<h3>Incorrect Login</h3>";
	}

?>