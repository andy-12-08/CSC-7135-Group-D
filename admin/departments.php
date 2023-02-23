<?php
// Establish a connection to the database
   include("../database/db_connect.php");

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define a query to fetch departments from the database
$sql = "SELECT id, sname FROM specialties";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $departments = array();
  while ($row = $result->fetch_assoc()) {
    $department = array(
      "id" => $row["id"],
      "name" => $row["sname"]
    );
    array_push($departments, $department);
  }

  // Return departments as a JSON response
  header("Content-Type: application/json");
  echo json_encode($departments);
} else {
  // Handle errors and return a 500 status code
  http_response_code(500);
  echo "Internal server error";
}

// Close the database connection
$conn->close();
?>