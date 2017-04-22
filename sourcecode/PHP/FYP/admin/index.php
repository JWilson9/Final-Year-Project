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

  <div id="adminInfo">
    Welcome to the admin dashboard !
    <form action="execSchedule.php" method="get">
  <button type="submit" class="btn btn-success">Schedule Timetable</button>
</form>
<form action="helpPage.php" method="get">
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
<?php
}
?>