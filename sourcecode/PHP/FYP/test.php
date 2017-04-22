<html>
	<!doctype html>
<html lang = "en">

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<title>MySchool</title>
	<link rel="stylesheet">


</head>



<?PHP
 
//$output;
$a = "hello";
 if (function_exists ( 'shell_exec' ))
 {
 	$output = shell_exec ( "java -cp TimeTable2.jar dynamicTT.TimetableMain -t classRoom.csv teacher.csv subjects.csv" );
 	echo output;
 } // checking to see if exec is enabled

 
?>
<script>
function GenerateTimetable(){
 
 

 //if (function_exists ( 'shell_exec' ))
 //{
 	//$output = shell_exec ( "java -cp HelloWorld.jar HelloWorld -t test.csv" );
 		
// } // checking to see if exec is enabled
 }
</script>
 
<?PHP
FUNCTION Generate(){
 GLOBAL $output;
 ECHO $output;
 }
 
?>
 
<button class="btn btn-primary" onclick="GenerateTimetable()">Generate Timetable</button>

<p id="demo"></p>


</html>