<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to database and check if the user exists
    // Add your database connection code here

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      // User exists, start a session and redirect to the main page
      session_start();
      $_SESSION['logged_in'] = true;
      $_SESSION['username'] = $username;
      header('Location: dashboard.php');
      exit;
    } else {
      // User does not exist, show an error message
      $error = "Incorrect username or password";
    }
  }
?>

<?php include 'html/login.html'; ?>

<?php if (isset($error)) { ?>
  <div class="error"><?php echo $error; ?></div>
<?php } ?>