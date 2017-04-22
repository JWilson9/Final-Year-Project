<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="../bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="../css/style.css" rel="stylesheet">

     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="../js/javaScript.js"></script>
   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top">
     <div class="container">
  
     </div>
  </nav>
 
  <div id="adminInfo">
    Welcome to the admin dashboard !
    <form action="execSchedule.php" method="get">
  <button type="submit" class="btn btn-success">Schedule Timetable</button>
</form>
<form action="execSchedule.php" method="get">
  <button type="submit" class="btn btn-primary">How do I schedule a timetable?</button>
</form>
    <!--
     <button class="btn btn-primary" id="spark-show" class="showLink" onclick="showHide('spark');return false;">Show more</button>
      <p id="spark" class="more"> 
        James uses HTML5, CSS, PHP, and javascript as well as using wordpress templates to complete his websites for his clients
            <br>
        <button class="btn btn-primary" id="spark-hide" class="hideLink" onclick="showHide('spark');return false;">Show Less</button>-->
  
  </div> 
  
  <div class="w3-row-padding">
  <div id="grad" class="w3-third"  >
        
    <h1 > List of Classes </h1>

    <?php

  $con=mysqli_connect("localhost","root","","fyp");
  //check connection

  if(mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysql_connect_error();
  }

  echo "<div '>";
  echo "<table class='table table-inverse'";
  echo "<tbody>";
  echo "
  <tr>
  <th>Classroom</th>
  <th>Student Group</th>
  </tr>";


  $result = mysqli_query($con, "SELECT * FROM classroom");
  while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['RoomName'] . "</td>";
    echo "<td>" . $row['StudGroup'] . "</td>";
    echo "</tr>";
    }
    

    echo "</tbody>";
    echo "</table>";
    echo "</div>";

  ?>

  </div>

  <div class="w3-third" id="grad" >
        
  <h1 > List of Subjects </h1>

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
  <th>Subject Name</th>
  <th>class Name</th>
  <th>Teacher ID</th>
  </tr>";


  $result = mysqli_query($con, "SELECT * FROM subject ORDER BY subject.teacherId ASC");
  while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['class_name'] . "</td>";
    echo "<td>" . $row['teacherId'] . "</td>";
    
    echo "</tr>";
    }

   echo "</table>";

  ?>

  </div>
   <div class="w3-third" id="grad">
        
    <h1 > List of Student Classes </h1>

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
  <th>Class Year</th>
  <th>Class Group</th>

  </tr>";


  $result = mysqli_query($con, "SELECT * FROM class ");
  while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['year'] . "</td>";
    echo "<td>" . $row['classGroup'] . "</td>";
    echo "</tr>";
    }
    


   echo "</table>";

  ?>

  </div>


  

</div>

  





  <nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container" id="adminInfo  ">
      James Wilson Final Year Project
    </div>
  </nav>




  

   
  </body>
</html>