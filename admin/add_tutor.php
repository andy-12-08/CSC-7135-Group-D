<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="../student/assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../student/assets/img/favicon.png">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<title> Admin Dashboard </title>
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
    or $_SESSION[ 'usertype' ] != 'A' ) {
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
$sqlmain = "select * from admin where aemail=? ";
$stmt = $conn->prepare( $sqlmain );
$stmt->bind_param( "s", $useremail );
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch[ "aemail" ];
$username = $userfetch[ "admin_name" ];

$studentrow = $conn->query( "select  * from  student;" );
$tutorrow = $conn->query( "select  * from  tutor;" );
$appointmentrow = $conn->query( "select  * from  appointment where appodate>='$today';" );
$schedulerow = $conn->query( "select  * from  schedule where scheduledate='$today';" );

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
	
	



  $tutorname = $_POST[ 'tutor_name' ];
  $tutormail = $_POST[ 'tutor_email' ];
  $departmentId = $_POST[ "department_id" ];
  $query = "INSERT INTO tutor ( tutoremail,tutorname,tutorpassword, specialties) VALUES ('$tutormail', '$tutorname','123','$departmentId')";

  if ( $conn->query( $query ) === true ) {
    $conn->query( "insert into webuser values('$tutormail','T',0)" );
    send_email( $tutormail, $tutorname );
     echo "<script>
            Swal.fire({
              title: 'Tutor Added!',
              text: 'You have succesfully addded the Tutor.',
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
      <li class="nav-item"> <a class="nav-link text-white " href="../admin/dashboard.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center"> <i class="material-icons opacity-10">dashboard</i> </div>
        <span class="nav-link-text ms-1">Dashboard</span> </a> </li>
      <li class="nav-item"> <a class="nav-link text-white active bg-gradient-primary" href="../admin/add_tutor.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center"> <i class="material-icons opacity-10">table_view</i> </div>
        <span class="nav-link-text ms-1">Tutor</span> </a> </li>
      <li class="nav-item"> <a class="nav-link text-white " href="../pages/billing.html">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center"> <i class="material-icons opacity-10">receipt_long</i> </div>
        <span class="nav-link-text ms-1">Support</span> </a> </li>
      
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
                <?php    echo 112 ?>
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
                <?php    echo $schedulerow ->num_rows  ?>
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
              <h6 class="text-white text-capitalize ps-3">Add Tutor</h6>
            </div>
          </div>
          <div class="card card-plain">
            <div class="card-body">
              <form role="form" id="add-tutor-form" action="add_tutor.php" method="post">
                <div class="input-group input-group-outline mb-3">
                  <label class="form-label" for="tutor-name">Tutor Name</label>
                  <input type="text" class="form-control" id="tutor_name" name="tutor_name" required>
                </div>
                <div class="input-group input-group-outline mb-3">
                  <label class="form-label" for="tutor-email">Email</label>
                  <input type="email" class="form-control" id="tutor_email" name="tutor_email" required>
                </div>
                <div class="input-group input-group-outline mb-3">
                  <select class="form-control form-control-lg" id="tutor-department" name="tutor-department">
                    <option value="">Select a department</option>
                  </select>
                </div>
                <input type="hidden" name="department_id" id="departmentIdInput" value="" required>
                <div class="text-center" style="float: right !important">
                  <input type="submit" value="add" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">
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
<script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }


          const departmentDropdown = document.getElementById("tutor-department");

          // Fetch departments from a database and add them to the dropdown
          fetch("../admin/departments.php")
              .then(response => response.json())
              .then(departments => {
                  departments.forEach(department => {
                      const option = document.createElement("option");
                      option.value = department.id;
                      option.text = department.name;
                      departmentDropdown.add(option);
                  });
              });

          // When a department is selected, get its id
          departmentDropdown.addEventListener("change", () => {
              const departmentId = departmentDropdown.value;
              console.log(`Selected department id: ${departmentId}`);
              departmentIdInput.value = departmentId;
          });

  //		// Handle form submission
  //		document.getElementById("add-tutor-form").addEventListener("submit", event => {
  //			event.preventDefault();
  //
  //			// Get form data
  //			const name = document.getElementById("tutor-name").value;
  //			const email = document.getElementById("tutor-email").value;
  //			const departmentId = departmentDropdown.value;
  //			const phone = document.getElementById("tutor-phone").value;
  //
  //			// TODO: Send form data to a server to add the tutor
  //			console.log("Form submitted!");
  //		});
  //	  
  //	  

    </script> 
<!-- Github buttons --> 
<script async defer src="https://buttons.github.io/buttons.js"></script> 
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc --> 
<script src="../student/assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body></html>
