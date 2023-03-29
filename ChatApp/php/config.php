<?php
  $hostname = "mysqldatabase.cncyjoyafhkj.us-east-1.rds.amazonaws.com";
  $username = "admin";
  $password = "SEgroupd";
  $dbname = "tutor_online";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
