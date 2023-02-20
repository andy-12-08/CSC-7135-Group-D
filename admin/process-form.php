<?php
 include("../database/db_connect.php");
 include '../sendemail/checkmail.php';
// process the form data here
$tutorname = $_POST['tutor_name'];
$tutormail = $_POST['tutor_email'];
$departmentId = $_POST["department_id"];
$query = "INSERT INTO tutor (tutoremail, tutorname, tutorpassword, specialties) VALUES ('$tutormail', '$tutorname', '123', '$departmentId')";

if ($conn->query($query) === TRUE) {
  $conn->query("INSERT INTO webuser VALUES ('$tutormail', 'T', 0)");
  send_email($tutormail, $tutorname);

} else {
  echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>