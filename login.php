<?php

include('header.php');
include('class/Appointment.php');

$object = new Appointment;

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



<div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
         <?php
			if(isset($_SESSION["success_message"]))
			{
				echo $_SESSION["success_message"];
				unset($_SESSION["success_message"]);
			}
			?>
			<span id="message"></span>
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In</h3>
              <p class="mb-4">Unleash Your Potential with Convenient, Quality Online Tutoring</p>
            </div>
        <form method="post" id="patient_login_form">
						<div class="form-group first">
							<label>Student Email Address</label>
							<input type="text" name="patient_email_address" id="patient_email_address" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
						</div>
						<div class="form-group last mb-4">
							<label>Student Password</label>
							<input type="password" name="patient_password" id="patient_password" class="form-control" required  data-parsley-trigger="keyup" />
						</div>

							<input type="hidden" name="action" value="patient_login" />
							<input type="submit" name="patient_login_button" id="patient_login_button" class="btn btn-block btn-primary" value="Login" />


						  <span class="d-block text-center my-4 text-muted">&mdash; Dont Have an account? &mdash;</span>
							    <button type="button"  id ="signup_button" class="btn btn-block btn-primary"
                 onclick="window.location.href='register.php'"> Register </button>

					</form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>



<?php

include('footer.php');

?>
    <script src="jslogin/popper.min.js"></script>
    <script src="jslogin/bootstrap.min.js"></script>
    <script src="jslogin/main.js"></script>
<script>

$(document).ready(function(){

	$('#patient_login_form').parsley();

	$('#patient_login_form').on('submit', function(event){


		event.preventDefault();

		if($('#patient_login_form').parsley().isValid())
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:$(this).serialize(),
				dataType:"json",
				beforeSend:function()
				{
					$('#patient_login_button').attr('disabled', 'disabled');
				},
				success:function(data)
				{
					$('#patient_login_button').attr('disabled', false);

					if(data.error != '')
					{
						$('#message').html(data.error);
					}
					else
					{
						window.location.href="dashboard.php";
					}
				}
			});
		}

	});

});



</script>