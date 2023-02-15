<?php
// Start the session
session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";
// Set the new timezone
date_default_timezone_set('America/New_York');
$date = date('Y-m-d');

$_SESSION["date"]=$date;

// $servername = "mysqldatabase.cncyjoyafhkj.us-east-1.rds.amazonaws.com";
// $username = "admin";
// $password = "SEgroupd";
// $dbname = "tutor_online";
// Create connection
include 'database/db_connect.php';
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Lsu TutorOnline";

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$conn) {
        die('Failed to connect to database: ' . mysqli_connect_error());
    }
        // Sanitize user input
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Construct the SQL query
        $sql = "SELECT * FROM users WHERE trim(username)= trim('$username') AND password='$password'";
        // Execute the query and get the result set
        $result = $conn->query($sql);
        // Check if the result set is not empty
        if ($result->num_rows > 0) {
        // Fetch the data from the result set
        $row = $result->fetch_assoc();
        echo $utype = $row['usertype'];

         if ($utype =='S'){
                //TODO
                //  Student dashbord
                $_SESSION['user']= $username;
                $_SESSION['usertype']='S';
                header('Location: student/dashboard.php');
                exit;
        } else {
        // Display an error message if the login failed
        $error = 'Invalid username or password';
        }

        // Close the database connection
        $conn->close();

        // Close the database connection
        mysqli_close($conn);
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>TutorOnline</title>
  </head>
  <body>



  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In</h3>
              <p class="mb-4">Unleash Your Potential with Convenient, Quality Online Tutoring</p>
            </div>
            <form action="login.php" method="post">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password">

              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">

              <span class="d-block text-center my-4 text-muted">&mdash; Dont Have an account? &mdash;</span>

              <div class="social-login">

                <button type="button"  id ="signup_button" class="btn btn-block btn-primary"
                 onclick="window.location.href='register.php'"> Register </button>
              </div>
            </form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>


    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>