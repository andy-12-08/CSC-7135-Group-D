    <?php
      include 'database/db_connect.php';
      include 'sendemail/mail.php';
      $data = array();
      function checkEmailDomain($email, $domain) {
      if (preg_match("/@".$domain."$/", $email)) {
        return true;
      } else {
        return false;
      }
    }
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['email'];

      if (checkEmailDomain($username, "lsu.edu")) {
        // Email ID is from the specific domain
         $password = $_POST['password'];
         $confirm_password = $_POST['confirm_password'];

       if($password == $confirm_password){
            $options = [
            'memory_cost' => 1<<17,
            'time_cost' => 4,
            'threads' => 2,
            ];
            $hash = password_hash($password,  PASSWORD_ARGON2I, $options);

            $sql = "INSERT INTO users (username, email, password)
            VALUES ( '$username', ' $username', '$hash')";
            if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            send_email($username, $username);
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
         }

      } else {

      }
      }
    ?>

    <?php include 'html/register.html'; ?>

    <?php if (isset($error)) { ?>
      <div class="error"><?php echo $error; ?></div>
    <?php } ?>