<?php
//  $servername = "mysqldatabase.cncyjoyafhkj.us-east-1.rds.amazonaws.com";
//  $username = "admin";
//  $password = "SEgroupd";
//  $dbname = "localhost";

   $servername = "ec2-54-196-156-86.compute-1.amazonaws.com";
   $username = "root";
   $password = "SEgroupd";
   $dbname = "tutor_online";

  // Create connection
 
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 $database = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  else{
 // echo "Database Connected";
  }
?> 