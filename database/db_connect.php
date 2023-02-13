<?php
   $servername = "mysqldatabase.cncyjoyafhkj.us-east-1.rds.amazonaws.com";
   $username = "admin";
   $password = "SEgroupd";
   $dbname = "tutor_online";

//  $servername = "localhost";
 // $username = "root";
 // $password = "";
 // $dbname = "tutor_online";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);



  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  else{
  echo "Database Connected";
  }
?>
