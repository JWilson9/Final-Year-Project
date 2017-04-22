<?php
if (function_exists ( 'shell_exec' )) {
	$output = shell_exec ( "java -cp TimeTable2.jar dynamicTT.TimeTableMain " );
	echo $output;
} // checking to see if exec is enabled
else{
	echo "failed";
}

header("location:index.php");
?>

