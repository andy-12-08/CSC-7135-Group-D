<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="../student/assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../student/assets/img/favicon.png">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<title> Tutor Dashboard </title>
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- Nucleo Icons -->
<link href="../student/assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="../student/assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- Font Awesome Icons --> 
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> 
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<!-- CSS Files -->
<link id="pagestyle" href="../student/assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.min.js"></script>
</head>
<?php
session_start();
include '../sendemail/checkmail.php';
include( "../database/db_connect.php" );
if ( isset( $_SESSION[ "user" ] ) ) {
  if ( ( $_SESSION[ "user" ] ) == ""
    or $_SESSION[ 'usertype' ] != 'T' ) {
    header( "location: ../login.php" );
  } else {
    $useremail = $_SESSION[ "user" ];
  }

} else {
  header( "location: ../login.php" );
}


if ( $conn->connect_error ) {
  die( "Connection failed: " . $conn->connect_error );
}

date_default_timezone_set( 'US/Eastern' );
$today = date( 'Y-m-d' );
$today;
$sqlmain = "select * from tutor where tutoremail=? ";
$stmt = $conn->prepare( $sqlmain );
$stmt->bind_param( "s", $useremail );
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch[ "tutoremail" ];
$username = $userfetch[ "tutorname" ];
$tutorid = $userfetch[ "tutorid" ];
$tutorsubject = $userfetch[ "specialties" ];

//SELECT * FROM appointment WHERE appodate >= CURDATE() IF (ROW_COUNT() = 0) THEN SELECT 0;
$studentrow = $conn->query( "select  * from  student;" );
$tutorrow = $conn->query( "select  * from  tutor;" );
$appointmentcount = 0;
$scheduletcount = 0;

$appointmentrow = $conn->query( "SELECT * FROM appointment WHERE appodate >= CURDATE()
    UNION
    SELECT 0 FROM DUAL WHERE NOT EXISTS(SELECT * FROM appointment WHERE appodate >= CURDATE());" );
if ( $appointmentrow === false ) {
  $appointmentcount == 0;
} else if ( is_null( $appointmentrow->num_rows ) || $appointmentrow->num_rows == 0 ) {
  $appointmentcount == 0;
} else {
  while ( $row = mysqli_fetch_assoc( $appointmentrow ) ) {
    $appointmentcount = $appointmentrow->num_rows;
  }
}

$schedulerow = $conn->query( "select  * from  schedule where scheduledate >= CURDATE()
   UNION
   SELECT 0 FROM DUAL WHERE NOT EXISTS(select  * from  schedule where scheduledate >= CURDATE();" );

if ( $schedulerow === false ) {
  $scheduletcount == 0;
} else if ( is_null( $schedulerow->num_rows ) || $schedulerow->num_rows == 0 ) {
  $scheduletcount == 0;
} else {
  while ( $row = mysqli_fetch_assoc( $schedulerow ) ) {
    $scheduletcount = $schedulerow->num_rows;
  }
}

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

  //$time = "14:30:00"; // Sample time
   echo $scheduleDate = $_POST[ 'schedule_date' ];
   echo $scheduleTime = $_POST[ 'schedule_time' ];
	

  $query = "INSERT INTO schedule (tutorid,title,scheduledate,scheduletime,nop) 
  VALUES ('$tutorid', '$tutorsubject',' $scheduleDate','$scheduleTime','N');";

  if ( $conn->query( $query ) === true ) {
   // send_email( $tutormail, $tutorname );
     echo "<script>
            Swal.fire({
              title: 'Schedule Added!',
              text: 'You have added your schedule.',
              icon: 'success'
            });
          </script>";
  } else {
  
  }
  $conn->close();

}


?>

<boody class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header"> <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i> <a class="navbar-brand m-0" href=" ../login.php" target="_blank"> <img src="../student/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo"> <span class="ms-1 font-weight-bold text-white"><?php echo $username?></span> </a> </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item"> <a class="nav-link text-white " href="../tutor/dashboard.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center"> <i class="material-icons opacity-10">dashboard</i> </div>
        <span class="nav-link-text ms-1">Dashboard</span> </a> </li>
      <li class="nav-item"> <a class="nav-link text-white active bg-gradient-primary" href="../tutor/add_schedule.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center"> <i class="material-icons opacity-10">table_view</i> </div>
        <span class="nav-link-text ms-1">Tutor</span> </a> </li>
      <li class="nav-item"> <a class="nav-link text-white " href="../pages/notifications.html">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center"> <i class="material-icons opacity-10">notifications</i> </div>
        <span class="nav-link-text ms-1">Notifications</span> </a> </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account Information</h6>
      </li>
      <li class="nav-item"> <a class="nav-link text-white " href="../pages/profile.html">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center"> <i class="material-icons opacity-10">person</i> </div>
        <span class="nav-link-text ms-1">Profile</span> </a> </li>
    </ul>
  </div>
  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3"> <a class="btn bg-gradient-primary mt-4 w-100" style ="display: none" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a> </div>
  </div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg "> 
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Dashboard</h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group input-group-outline">
            <label class="form-label">Type here...</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center"> <a href="../pages/sign-in.html" class="nav-link text-body font-weight-bold px-0"> <i class="fa fa-user me-sm-1"></i> <span class="d-sm-inline d-none">Admin</span> </a> </li>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center"> <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner"> <i class="sidenav-toggler-line"></i> <i class="sidenav-toggler-line"></i> <i class="sidenav-toggler-line"></i> </div>
            </a> </li>
          <li class="nav-item px-3 d-flex align-items-center"> <a href="javascript:;" class="nav-link text-body p-0"> <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i> </a> </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute"> <i class="material-icons opacity-10">weekend</i> </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Total Tutors</p>
              <h4 class="mb-0"><?php echo $tutorrow->num_rows ?></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute"> <i class="material-icons opacity-10">person</i> </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Total Students</p>
              <h4 class="mb-0">
                <?php    echo $studentrow->num_rows  ?>
              </h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute"> <i class="material-icons opacity-10">person</i> </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Total Appointments</p>
              <h4 class="mb-0">
                <?php    echo $appointmentcount ?>
              </h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute"> <i class="material-icons opacity-10">weekend</i> </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Today's Appointment</p>
              <h4 class="mb-0">
                <?php    echo $scheduletcount ?>
              </h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Add Schedule</h6>
            </div>
          </div>
          <div class="card card-plain">
            <div class="card-body">
				
		<form method="post" action="add_schedule.php">
			
			 <div class="input-group input-group-outline mb-3">
				<input type="date" name="schedule_date" required><br>
			</div>
			 <div class="input-group input-group-outline mb-3">
				<label for="schedule_time">Time:</label>
			    <input type="time" class="without_ampm" step ="1200" id="schedule_time" name="schedule_time" min="09:00" max="17:00">
			</div>
                <small>Enter a valid time between 09:00 and 18:00, in 20-minute intervals</small>
		 <div class="input-group input-group-outline mb-3">

                <input type="hidden" name="department_id" id="departmentIdInput" value="" required>
				<input type="submit" name="submit" value="Add Schedule">
			</div>
		</form>
				
			
				
				
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!--   Core JS Files   --> 
<script src="../student/assets/js/core/popper.min.js"></script> 
<script src="../student/assets/js/core/bootstrap.min.js"></script> 
<script src="../student/assets/js/plugins/perfect-scrollbar.min.js"></script> 
<script src="../student/assets/js/plugins/smooth-scrollbar.min.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
	<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>

<script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
	
//	const inputTime = document.getElementById('schedule_time').value; // get the value of the input
//	const time = inputTime.split(':'); // split the input into hours and minutes
//	let hours = parseInt(time[0]);
//	let minutes = time[1];
//	let amPm = hours >= 12 ? 'PM' : 'AM'; // determine if it's AM or PM
//	hours = hours % 12; // convert to 12-hour format
//	hours = hours ? hours : 12; // handle 0 case
//	if (hours === 12 && minutes === undefined) {
//     amPm = 'AM';
//   }
//	
//	
//	const formattedTime = hours + ':' + minutes + ' ' + amPm; // format the time with AM/PM
//	console.log(formattedTime); 
//		departmentIdInput.value = formattedTime;
	
	
	var timepicker = new TimePicker('time', {
	lang: 'en',
	theme: 'dark'
	});
	timepicker.on('change', function(evt) {

	var value = (evt.hour || '00') + ':' + (evt.minute || '00');
	evt.element.value = value;

	});



	  

    </script> 
<!-- Github buttons --> 
<script async defer src="https://buttons.github.io/buttons.js"></script> 
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc --> 
<script src="../student/assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body></html>
