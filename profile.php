
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="student/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="student/assets/img/favicon.png">
  <title>
    Student Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="student/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="student/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="student/assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
</head>

<boody class="g-sidenav-show  bg-gray-200">


<?php
include('class/Appointment.php');

$object = new Appointment;
$object->query = "
SELECT * FROM patient_table 
WHERE patient_id = '".$_SESSION["patient_id"]."'
";

$result = $object->get_result();
	
	


?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" >
        <img src="student/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white"><?php  ?></span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white " href="dashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Book Appoinment</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="appointment.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">My Appointment</span>
          </a>
        </li>
       
     
   
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/notifications.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account Information</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active  bg-gradient-primary " href="profile.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
		  
		      <li class="nav-item">
          <a class="nav-link text-white " href="logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      	
		</ul>
    </div>
 
  </aside>
	
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
	  <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Student</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
    
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">	 
		<div class="row">
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
				<div class="card">
				<div class="card-header p-3 pt-2">
				<div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
				<i class="material-icons opacity-10">weekend</i>
				</div>
				<div class="text-end pt-1">
				<p class="text-sm mb-0 text-capitalize">Total Tutors</p>
				<h4 class="mb-0"><?php   ?></h4>
				</div>
				</div>


				</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
				<div class="card">
				<div class="card-header p-3 pt-2">
				<div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
				<i class="material-icons opacity-10">person</i>
				</div>
				<div class="text-end pt-1">
				<p class="text-sm mb-0 text-capitalize">Total Students</p>
				<h4 class="mb-0"><?php       ?></h4>
				</div>
				</div>


				</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
				<div class="card">
				<div class="card-header p-3 pt-2">
				<div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
				<i class="material-icons opacity-10">person</i>
				</div>
				<div class="text-end pt-1">
				<p class="text-sm mb-0 text-capitalize">New Appointments</p>
				<h4 class="mb-0"><?php     ?></h4>
				</div>
				</div>
				</div>
				</div>
				<div class="col-xl-3 col-sm-6">
				<div class="card">
				<div class="card-header p-3 pt-2">
				<div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
				<i class="material-icons opacity-10">weekend</i>
				</div>
				<div class="text-end pt-1">
				<p class="text-sm mb-0 text-capitalize">Today's Appointment</p>
				<h4 class="mb-0"> <?php     ?></h4>
				</div>
				</div>
				</div>
				</div>
		</div>
    </div>
	
	<div class="container-fluid py-4">
		
	<div class="row justify-content-md-center">
		<div class="col col-md-6">
			<br />
			<?php
			if(isset($_GET['action']) && $_GET['action'] == 'edit')
			{
			?>
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">
							Edit Profile Details
						</div>
						<div class="col-md-6 text-right">
							<a href="profile.php" class="btn btn-secondary btn-sm">View</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" id="edit_profile_form">
						<div class="form-group">
							<label>Student Email Address<span class="text-danger">*</span></label>
							<input type="text" name="patient_email_address" id="patient_email_address" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" readonly />
						</div>
						<div class="form-group">
							<label>Student Password<span class="text-danger">*</span></label>
							<input type="password" name="patient_password" id="patient_password" class="form-control" required  data-parsley-trigger="keyup" />
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
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Student Date of Birth<span class="text-danger">*</span></label>
									<input type="text" name="patient_date_of_birth" id="patient_date_of_birth" class="form-control" required  data-parsley-trigger="keyup" readonly />
								</div>
							</div>
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
									<label>Student Maritial Status<span class="text-danger">*</span></label>
									<select name="patient_maritial_status" id="patient_maritial_status" class="form-control">
										<option value="Single">Single</option>
										<option value="Married">Married</option>
										<option value="Seperated">Seperated</option>
										<option value="Divorced">Divorced</option>
										<option value="Widowed">Widowed</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Student Complete Address<span class="text-danger">*</span></label>
							<textarea name="patient_address" id="patient_address" class="form-control" required data-parsley-trigger="keyup"></textarea>
						</div>
						<div class="form-group text-center">
							<input type="hidden" name="action" value="edit_profile" />
							<input type="submit" name="edit_profile_button" id="edit_profile_button" class="btn btn-primary" value="Edit" />
						</div>
					</form>
				</div>
			</div>

			<br />
			<br />

			<?php
			}
			else
			{
				if(isset($_SESSION['success_message']))
				{
					echo $_SESSION['success_message'];
					unset($_SESSION['success_message']);
				}
			?>
		
			<br />
			<br />
			<?php
			}
			?>
		</div>
	
		
	<div class="row">
        <div class="col-12">
          <div class="card my-4">
			  
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">My Details</h6>
              </div>
            </div>
			  
			  
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date of Birth</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    </tr>
                  </thead>
					<?php
						foreach($result as $row)
						{
						?>
					
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <!--<img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">-->
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $row["patient_first_name"] . ' ' . $row["patient_last_name"]; ?></h6>
                           
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $row["patient_address"]; ?></p>
                        
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success"><?php echo $row["patient_phone_no"]; ?></span>
                      </td>
						
						
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row["patient_date_of_birth"]; ?></span>
                      </td>
						
						
					   <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row["patient_email_address"]; ?></span>
                      </td>
						
            
                    </tr>
                  </tbody>
					
					<?php
						}
						?>	
					
                </table>
              </div>
            </div>
         
			
			</div>
        </div>
      </div>
		
		
		
		</div>
    
    </div>
	
</main>	
	
</div>





<?php
include('footer.php');
?>



  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
	  
$(document).ready(function(){

	$('#patient_date_of_birth').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });

<?php
	foreach($result as $row)
	{

?>
$('#patient_email_address').val("<?php echo $row['patient_email_address']; ?>");
$('#patient_password').val("<?php echo $row['patient_password']; ?>");
$('#patient_first_name').val("<?php echo $row['patient_first_name']; ?>");
$('#patient_last_name').val("<?php echo $row['patient_last_name']; ?>");
$('#patient_date_of_birth').val("<?php echo $row['patient_date_of_birth']; ?>");
$('#patient_gender').val("<?php echo $row['patient_gender']; ?>");
$('#patient_phone_no').val("<?php echo $row['patient_phone_no']; ?>");
$('#patient_maritial_status').val("<?php echo $row['patient_maritial_status']; ?>");
$('#patient_address').val("<?php echo $row['patient_address']; ?>");

<?php

	}

?>

	$('#edit_profile_form').parsley();

	$('#edit_profile_form').on('submit', function(event){

		event.preventDefault();

		if($('#edit_profile_form').parsley().isValid())
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:$(this).serialize(),
				beforeSend:function()
				{
					$('#edit_profile_button').attr('disabled', 'disabled');
					$('#edit_profile_button').val('wait...');
				},
				success:function(data)
				{
					window.location.href = "profile.php";
				}
			})
		}

	});

});
	  
	  
	  
	  
  </script>
  <!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="student/assets/js/material-dashboard.min.js?v=3.0.4"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
</body>

</html>