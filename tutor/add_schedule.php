<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="../student/assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../student/assets/img/favicon.png">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<title> Tutor Dashboard </title>->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<link href="../student/assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="../student/assets/css/nucleo-svg.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<link id="pagestyle" href="../student/assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.min.css">
</head>
<?php
session_start();
include '../sendemail/checkmail.php';
include( "../database/db_connect.php" );
	
include('header.php');
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


$appointmentrow = $conn->query( "SELECT IFNULL(COUNT(*), 0) AS num_appointments
	FROM appointment
	WHERE appodate >= CURDATE();" );

	$row = $appointmentrow->fetch_assoc();
	$num_appointments = $row['num_appointments']; 

	$appointmentcount = $num_appointments;
$schedulerow = $conn->query( "SELECT IFNULL(COUNT(*), 0) AS num_schedule
	FROM schedule
	WHERE scheduledate >= CURDATE();");

	$row = $schedulerow->fetch_assoc();
	$num_schedule = $row['num_schedule']; 
    $scheduletcount = $num_schedule;
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
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col">
                            		<h6 class="m-0 font-weight-bold text-primary">Tutor Schedule List</h6>
                            	</div>
                            	<div class="col" align="right">
                            		<button type="button" name="add_exam" id="add_doctor_schedule" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></button>
                            	</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="doctor_schedule_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <?php
                                            if($_SESSION['type'] == 'Admin')
                                            {
                                            ?>
                                            <th>Doctor Name</th>
                                            <?php
                                            }
                                            ?>
                                            <th>Schedule Date</th>
                                            <th>Schedule Day</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Consulting Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
  </div>
</main>


<div id="doctor_scheduleModal" class="modal fade">
  	<div class="modal-dialog">
    	<form method="post" id="doctor_schedule_form">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="modal_title">Add Doctor Schedule</h4>
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		</div>
        		<div class="modal-body">
        			<span id="form_message"></span>
                    <?php
                    if($_SESSION['type'] == 'Admin')
                    {
                    ?>
                    <div class="form-group">
                        <label>Select Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                            <option value="">Select Doctor</option>
                            <?php
                            $object->query = "
                            SELECT * FROM doctor_table 
                            WHERE doctor_status = 'Active' 
                            ORDER BY doctor_name ASC
                            ";

                            $result = $object->get_result();

                            foreach($result as $row)
                            {
                                echo '
                                <option value="'.$row["doctor_id"].'">'.$row["doctor_name"].'</option>
                                ';
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label>Schedule Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" name="doctor_schedule_date" id="doctor_schedule_date" class="form-control" required readonly />
                        </div>
                    </div>
		          	<div class="form-group">
		          		<label>Start Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                            </div>
		          		    <input type="text" name="doctor_schedule_start_time" id="doctor_schedule_start_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                        </div>
		          	</div>
                    <div class="form-group">
                        <label>End Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                            </div>
                            <input type="text" name="doctor_schedule_end_time" id="doctor_schedule_end_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_end_time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Average Consulting Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                            </div>
                            <select name="average_consulting_time" id="average_consulting_time" class="form-control" required>
                                <option value="">Select Consulting Duration</option>
                                <?php
                                $count = 0;
                                for($i = 1; $i <= 15; $i++)
                                {
                                    $count += 5;
                                    echo '<option value="'.$count.'">'.$count.' Minute</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
        		</div>
        		<div class="modal-footer">
          			<input type="hidden" name="hidden_id" id="hidden_id" />
          			<input type="hidden" name="action" id="action" value="Add" />
          			<input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Add" />
          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		</div>
      		</div>
    	</form>
  	</div>
</div>	
	

	
</body></html>
<?php

include('footer.php');

?>S
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />

<script>
$(document).ready(function(){

	var dataTable = $('#doctor_schedule_table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"doctor_schedule_action.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
                <?php
                if($_SESSION['type'] == 'Admin')
                {
                ?>
                "targets":[6, 7],
                <?php
                }
                else
                {
                ?>
                "targets":[5, 6],
                <?php
                }
                ?>
				
				"orderable":false,
			},
		],
	});

    var date = new Date();
    date.setDate(date.getDate());

    $('#doctor_schedule_date').datepicker({
        startDate: date,
        format: "yyyy-mm-dd",
        autoclose: true
    });

    $('#doctor_schedule_start_time').datetimepicker({
        format: 'HH:mm'
    });

    $('#doctor_schedule_end_time').datetimepicker({
        useCurrent: false,
        format: 'HH:mm'
    });

    $("#doctor_schedule_start_time").on("change.datetimepicker", function (e) {
        console.log('test');
        $('#doctor_schedule_end_time').datetimepicker('minDate', e.date);
    });

    $("#doctor_schedule_end_time").on("change.datetimepicker", function (e) {
        $('#doctor_schedule_start_time').datetimepicker('maxDate', e.date);
    });

	$('#add_doctor_schedule').click(function(){
		
		$('#doctor_schedule_form')[0].reset();

		$('#doctor_schedule_form').parsley().reset();

    	$('#modal_title').text('Add Doctor Schedule Data');

    	$('#action').val('Add');

    	$('#submit_button').val('Add');

    	$('#doctor_scheduleModal').modal('show');

    	$('#form_message').html('');

	});

	$('#doctor_schedule_form').parsley();

	$('#doctor_schedule_form').on('submit', function(event){
		event.preventDefault();
		if($('#doctor_schedule_form').parsley().isValid())
		{		
			$.ajax({
				url:"doctor_schedule_action.php",
				method:"POST",
				data:$(this).serialize(),
				dataType:'json',
				beforeSend:function()
				{
					$('#submit_button').attr('disabled', 'disabled');
					$('#submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#submit_button').attr('disabled', false);
					if(data.error != '')
					{
						$('#form_message').html(data.error);
						$('#submit_button').val('Add');
					}
					else
					{
						$('#doctor_scheduleModal').modal('hide');
						$('#message').html(data.success);
						dataTable.ajax.reload();

						setTimeout(function(){

				            $('#message').html('');

				        }, 5000);
					}
				}
			})
		}
	});

	$(document).on('click', '.edit_button', function(){

		var doctor_schedule_id = $(this).data('id');

		$('#doctor_schedule_form').parsley().reset();

		$('#form_message').html('');

		$.ajax({

	      	url:"doctor_schedule_action.php",

	      	method:"POST",

	      	data:{doctor_schedule_id:doctor_schedule_id, action:'fetch_single'},

	      	dataType:'JSON',

	      	success:function(data)
	      	{
                <?php
                if($_SESSION['type'] == 'Admin')
                {
                ?>
                $('#doctor_id').val(data.doctor_id);
                <?php
                }
                ?>
	        	$('#doctor_schedule_date').val(data.doctor_schedule_date);

                $('#doctor_schedule_start_time').val(data.doctor_schedule_start_time);

                $('#doctor_schedule_end_time').val(data.doctor_schedule_end_time);

	        	$('#modal_title').text('Edit Doctor Schedule Data');

	        	$('#action').val('Edit');

	        	$('#submit_button').val('Edit');

	        	$('#doctor_scheduleModal').modal('show');

	        	$('#hidden_id').val(doctor_schedule_id);

	      	}

	    })

	});

	$(document).on('click', '.status_button', function(){
		var id = $(this).data('id');
    	var status = $(this).data('status');
		var next_status = 'Active';
		if(status == 'Active')
		{
			next_status = 'Inactive';
		}
		if(confirm("Are you sure you want to "+next_status+" it?"))
    	{

      		$.ajax({

        		url:"doctor_schedule_action.php",

        		method:"POST",

        		data:{id:id, action:'change_status', status:status, next_status:next_status},

        		success:function(data)
        		{

          			$('#message').html(data);

          			dataTable.ajax.reload();

          			setTimeout(function(){

            			$('#message').html('');

          			}, 5000);

        		}

      		})

    	}
	});

	$(document).on('click', '.delete_button', function(){

    	var id = $(this).data('id');

    	if(confirm("Are you sure you want to remove it?"))
    	{

      		$.ajax({

        		url:"doctor_schedule_action.php",

        		method:"POST",

        		data:{id:id, action:'delete'},

        		success:function(data)
        		{

          			$('#message').html(data);

          			dataTable.ajax.reload();

          			setTimeout(function(){

            			$('#message').html('');

          			}, 5000);

        		}

      		})

    	}

  	});

});
</script>	