<?php

include 'database/db_connect.php';
 $verification_code = $_GET['code'];


// Update the database column
$sql = "UPDATE webuser SET email_verification	 = 1 WHERE trim(email) = trim('$verification_code')";

if (mysqli_query($conn, $sql)) {
    echo 'Your email address has been verified. Thank you!';
} else {
    echo 'An error occurred. Please try again later.';
}

mysqli_close($conn);
?>