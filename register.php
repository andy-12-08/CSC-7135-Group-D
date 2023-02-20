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
       $email = $_POST['email'];
	   $username = $_POST['username'];  
	

      if (checkEmailDomain($email, "lsu.edu")) {
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
		   
		   
		$sqlmain= "select * from webuser where email=?;";
        $stmt = $conn->prepare($sqlmain);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows==1){
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
        }else{
            //TODO
            $conn->query("insert into student(semail,sname,spassword) 
			values('$email','$username','$hash');");
            $conn->query("insert into webuser values('$email','S',0)");
             send_email($email, $username);
            //print_r("insert into patient values($pid,'$email','$fname','$lname','$newpassword','$address','$nic','$dob','$tele');");
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="S";
            $_SESSION["username"]=$username;

            header('Location: http://phpapplication-env.eba-mrbqpmvh.us-east-1.elasticbeanstalk.com/index.php');
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
        }
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   

		  

//            $sql = "INSERT INTO users (username, email, password,usertype)
//            VALUES ( '$username', ' $username', '$password','S')";
//            if (mysqli_query($conn, $sql)) {
//				
//		
//			
//            echo "New record created successfully";
//            send_email($username, $username);
//            header("Location: http://phpapplication-env.eba-mrbqpmvh.us-east-1.elasticbeanstalk.com/index.php");
//            } else {
//            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//            }
//            mysqli_close($conn);
         }

      } else {

      }
      }
    ?>

    <?php include 'html/register.html'; ?>

    <?php if (isset($error)) { ?>
      <div class="error"><?php echo $error; ?></div>
    <?php } ?>
