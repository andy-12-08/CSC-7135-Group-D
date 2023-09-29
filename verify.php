<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Modal</title>
    <link rel="stylesheet" href="styles.css">
</head>


<?php

include ('database/db_connect.php');
$verification_code = $_GET['code'];
$sql = "UPDATE student_table SET email_verify = 'Yes' WHERE trim(student_email_address) = trim('$verification_code')";
if (mysqli_query($conn, $sql)) {
   // echo 'Your email address has been verified. Thank you!';
} else {
    echo 'An error occurred. Please try again later.';
}
mysqli_close($conn);

include('footer.php');

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="csslogin/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="csslogin/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="csslogin/style.css">

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
			<span id="message"></span>
            <div class="col-md-8">
              <div class="mb-4">
              <h3 style="color: cadetblue">Verification Done </h3>
				  
				  <button onclick="showVerificationMessageAndRedirect()">Click Redirect</button>
            </div>
       
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
	
	</body>
	</html>

<script>
function showVerificationMessageAndRedirect() {
    document.getElementById('message').innerHTML = '<h3 style="color: cadetblue">Please wait...</h3>';
    setTimeout(function() {
        window.location.href = 'login.php';
    }, 50); // Wait for 5000 milliseconds (5 seconds) before redirecting
}
</script>




