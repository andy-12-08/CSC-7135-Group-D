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



<?php
// include('header.php');
include('class/Appointment.php');
function checkEmailDomain($email, $domain) {
	if (preg_match("/@".$domain."$/", $email)) {
	  return true;
	} else {
	  return false;
	}
  }
?>

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
                            <h3>Register</h3>
                            <p class="mb-4">Unleash Your Potential with Convenient, Quality Online Tutoring</p>
                        </div>
                                  <span id="message"></span>
                        	<form method="post" id="patient_register_form">
						<div class="form-group">
							<label>Student Email Address<span class="text-danger">*</span></label>
							<input type="text" name="patient_email_address" id="patient_email_address" class="form-control" 
							required autofocus placeholder="example@lsu.edu" pattern="^[A-Za-z0-9._%+-]+@lsu\.edu$" data-parsley-trigger="keyup" />
						</div>
						<div class="form-group">
							<label>Student Password<span class="text-danger">*</span></label>
							<input type="password" name="patient_password" id="patient_password" class="form-control" required  data-parsley-trigger="keyup" />
							<p id="error" class="text-danger" style="display:none">Invalid email. Please use an email ending with '@lsu.edu'.</p>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Student First Name<span class="text-danger">*</span></label>
									<input type="text" name="patient_first_name" id="patient_first_name" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Student Last Name<span class="text-danger">*</span></label>
									<input type="text" name="patient_last_name" id="patient_last_name" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Student Date of Birth<span class="text-danger">*</span></label>
									<input type="text" name="patient_date_of_birth" id="patient_date_of_birth" class="form-control" required  data-parsley-trigger="keyup" readonly />
								</div>
							</div> -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Student Gender<span class="text-danger">*</span></label>
									<select name="patient_gender" id="patient_gender" class="form-control">
										<option value="Male">Male</option>
										<option value="Female">Female</option>
										<option value="Other">Other</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Student Contact No.<span class="text-danger">*</span></label>
									<input type="text" name="patient_phone_no" id="patient_phone_no" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Student Department <span class="text-danger"></span></label>
									<select name="patient_maritial_status" id="patient_maritial_status" class="form-control">
										<option value="CSE">Computer Science and Engineering</option>
										<option value="CE">Chemical Engineering</option>
										<option value="EEE">Electrical Engineering</option>
										<option value="ME">Mechanical Engineering</option>
										<option value="Other">Other</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Student Complete Address<span class="text-danger">*</span></label>
							<textarea name="patient_address" id="patient_address" class="form-control" required data-parsley-trigger="keyup"></textarea>
						</div>
						<div class="form-group text-center">
							<input type="hidden" name="action" value="patient_register" />
							<input type="submit" name="patient_register_button" id="patient_register_button" class="btn btn-primary" value="Register" />
						</div>

						<div class="form-group text-center">
							<p><a href="login.php">Login</a></p>
						</div>
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

<script>

$(document).ready(function(){

	$('#patient_date_of_birth').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });

	$('#patient_register_form').parsley();

	$('#patient_register_form').on('submit', function(event){

		event.preventDefault();

		var emailInput = document.getElementById("patient_email_address");
            var errorElement = document.getElementById("error");
            var email = emailInput.value;

            if (email.endsWith("@lsu.edu")) {
                errorElement.style.display = "none"; // Hide the error message
                // Proceed with form submission or other tasks
            } else {
                errorElement.style.display = "block"; // Show the error message
            }


		if($('#patient_register_form').parsley().isValid())
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:$(this).serialize(),
				dataType:'json',
				beforeSend:function(){
					$('#patient_register_button').attr('disabled', 'disabled');
				},
				success:function(data)
				{
					$('#patient_register_button').attr('disabled', false);
					$('#patient_register_form')[0].reset();
					if(data.error !== '')
					{
						$('#message').html(data.error);
					}
					if(data.success !== '')
					{
						$('#message').html(data.success);
						
						$('#message').html('<div class="alert alert-success">Registration successful! Redirecting to the login page...</div>');
						setTimeout(function () {
						window.location.href = 'login.php';
						}, 2000);
					}
				}
			});
		}

	});
	
	$('#patient_register_form').on('submit', function(event){
    event.preventDefault();
    });


});

</script>