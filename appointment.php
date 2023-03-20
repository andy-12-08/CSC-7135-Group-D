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
	
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="vendor/parsley/parsley.css"/>
  <link rel="stylesheet" type="text/css" href="vendor/datepicker/bootstrap-datepicker.css"/>
</head>

<boody class="g-sidenav-show  bg-gray-200">

<style>
	
	    	.border-top { border-top: 1px solid #e5e5e5; 
	}
			.border-bottom { border-bottom: 1px solid #e5e5e5; 
	}

			.box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
	}
	
	.page-item .page-link, .page-item span {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #7b809a;
    padding: 0;
    margin: 0 3px;
    border-radius: 0% !important;
    width: 70px!important;
    height: 36px;
    font-size: 0.875rem;
}
	
	.navbar .navbar-brand {
    color: #dee2e6!important;
    font-size: 0.875rem;
}
	
	div.dataTables_wrapper div.dataTables_info {
    padding-top: 0.85em;
    display: none!important;
}
	
	.page-link.active, .active>.page-link {
    z-index: 3;
    color: var(--bs-pagination-active-color);
    background-color: #0088cc!important;
    border-color: #0088cc!important;
}
	.form-control {
    border: 1px solid black !important;
}
	
table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  color: #444;
}

/* Table header styles */
th {
  background-color: #f2f2f2;
  text-transform: uppercase;
  font-weight: bold;
  padding: 10px 15px;
  /*border: 1px solid #ccc;*/
}

/* Table cell styles */
td {
  padding: 10px 15px;
  border: 1px solid #ccc;
  vertical-align: middle;
  font-size: 14px;
}

/* Row hover effect */
tr:hover {
  background-color: #f5f5f5;
}

/* Alternating row colors */
tr:nth-child(even) {
  background-color: #f9f9f9;
}
	
	
</style>



<?php
include('class/Appointment.php');

$object = new Appointment;

//include('appointmentheader.php');

?>
 
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" >
        <img src="student/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white"><?php ?></span>
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
          <a class="nav-link text-white active  bg-gradient-primary active" href="appointment.php">
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
          <a class="nav-link text-white" href="profile.php">
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
		<div class="row">
			<div class="col-12">
                <div class="card my-4">
			
						<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="border-bottom: none !important">
						<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
						<h6 class="text-white text-capitalize ps-3">My Appointments</h6>
						</div>
						</div>

						<div class="card-body">
						<div class="table-responsive">
						<div class="table-responsive p-0">
						<table class="table align-items-center mb-0s" id="appointment_list_table">
						<thead>
						<tr>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Appointment No.</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tutor Name</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Appointment Date</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Appointment Time</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Appointment Day</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Appointment Status</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Download</th>
						</tr>
						</thead>

						</table>
						</div>
						</div>
						</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
	

	</main>

	
<?php

include('footer.php');

?>


<script>

$(document).ready(function(){

	var dataTable = $('#appointment_list_table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"action.php",
			type:"POST",
			data:{action:'fetch_appointment'}
		},
		"columnDefs":[
			{
                "targets":[6, 6],				
				"orderable":false,
			},
		],
	});

	$(document).on('click', '.cancel_appointment', function(){
		var appointment_id = $(this).data('id');
		if(confirm("Are you sure you want to cancel this appointment?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{appointment_id:appointment_id, action:'cancel_appointment'},
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
	
	
</body>

</html>	
	
	
	
	
	
	