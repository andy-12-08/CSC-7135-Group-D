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
	
	.border-top { border-top: 1px solid #e5e5e5;}
	.border-bottom { border-bottom: 1px solid #e5e5e5;}
	.box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);}

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
	.page-link.active, .active>.page-link {
	z-index: 3;
	color: var(--bs-pagination-active-color);
	background-color: #0088cc!important;
	border-color: #0088cc!important;
	}
	.form-control {
	border: 1px solid black !important;
	}


	/* General modal styles */
	.modal {
	  font-family: Arial, sans-serif;
	}
	.modal.fade {
	  opacity: 0;
	  transition: opacity 0.3s ease-in-out;
	}
	.modal.show {
	  opacity: 1;
	}
	.modal-header {
	  background-color: #49a3f1;
	  color: #FFFFFF!important;
	  font-weight: bold;
	  border-bottom: none;
	}
	.modal_title{
	   color: #FFFFFF!important;
		}
	.modal-header .close {
	  color: #333;
	  font-weight: bold;
	  opacity: 1;
	}
	.modal-body {
	  padding: 20px;
	}
	.modal-body label {
	  font-weight: bold;
	  display: block;
	  margin-bottom: 5px;
	}
	.modal-body textarea {
	  border: 1px solid #ccc;
	  border-radius: 5px;
	  resize: none;
	}

	/* Form message */
	#form_message {
	  display: block;
	  margin-bottom: 10px;
	}

	/* Modal footer */
	.modal-footer {
	  border-top: none;
	}
	.modal-footer .btn {
	  border-radius: 5px;
	}
	.modal-footer .btn-success {
	  background-color: #49a3f1;
	  border-color: #49a3f1;
	}
	.modal-footer .btn-default {
	  background-color: #ccc;
	  border-color: #ccc;
	  color: #333;
	}
	.modal-footer .btn:hover,
	.modal-footer .btn:focus {
	  opacity: 0.9;
	}
	
	div.dataTables_wrapper div.dataTables_info {
    padding-top: 0.85em;
    display: none!important;
}

.bg-gradient-primary{
  background-image: linear-gradient(195deg, #483d8b 0%, #483d8b 100%) !important;
}

</style>

<?php
include('class/Appointment.php');
$object = new Appointment;
include('student_header.php');
?>

<!-- <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
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
          <a class="nav-link text-white active  bg-gradient-primary active " href="dashboard.php">
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
 
  </aside>	 -->
	




  <div class="container-fluid py-4">
	<div class="row justify-content-md-center">
		<div class="row">
			<div class="col-12">
                <div class="card my-4">
			
						<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="border-bottom: none !important">
						<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
						<h6 class="text-white text-capitalize ps-3">Book Appointments</h6>
						</div>
						</div>
								<div class="card-body">
								<div class="table-responsive">	
									<div class="table-responsive p-0">
										<table class="table align-items-center mb-0s" id="appointment_list_table">
											<thead>
											<tr>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tutor Name</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rating</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Education</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Speciality</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Appointment Date</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Appointment Day</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Available Time</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
											</tr>
											</thead>
										<tbody></tbody>
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




<div id="appointmentModal" class="modal fade">
  	<div class="modal-dialog">
    	<form method="post" id="appointment_form">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="modal_title">Make Appointment</h4>
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		</div>
        		<div class="modal-body">
        			<span id="form_message"></span>
                    <div id="appointment_detail"></div>
                    <div class="form-group">
                    	<label><b>Reasone for Appointment</b></label>
                    	<textarea name="reason_for_appointment" id="reason_for_appointment" class="form-control" required rows="5"></textarea>
                    </div>
        		</div>
        		<div class="modal-footer">
          			<input type="hidden" name="hidden_doctor_id" id="hidden_doctor_id" />
          			<input type="hidden" name="hidden_doctor_schedule_id" id="hidden_doctor_schedule_id" />
          			<input type="hidden" name="action" id="action" value="book_appointment" />
          			<input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Book" />
          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		</div>
      		</div>
    	</form>
  	</div>
</div>


<script>
$(document).ready(function(){

	var dataTable = $('#appointment_list_table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"action.php",
			type:"POST",
			data:{action:'fetch_schedule'}
		},
		"columnDefs":[
			{
                "targets":[7],				
				"orderable":false,
			},
		],
	});

	$(document).on('click', '.get_appointment', function(){

		var doctor_schedule_id = $(this).data('doctor_schedule_id');
		var doctor_id = $(this).data('doctor_id');

		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:'make_appointment', doctor_schedule_id:doctor_schedule_id},
			success:function(data)
			{
				$('#appointmentModal').modal('show');
				$('#hidden_doctor_id').val(doctor_id);
				$('#hidden_doctor_schedule_id').val(doctor_schedule_id);
				$('#appointment_detail').html(data);
			}
		});

	});

	$('#appointment_form').parsley();

	$('#appointment_form').on('submit', function(event){

		event.preventDefault();

		if($('#appointment_form').parsley().isValid())
		{

			$.ajax({
				url:"action.php",
				method:"POST",
				data:$(this).serialize(),
				dataType:"json",
				beforeSend:function(){
					$('#submit_button').attr('disabled', 'disabled');
					$('#submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#submit_button').attr('disabled', false);
					$('#submit_button').val('Book');
					if(data.error != '')
					{
						$('#form_message').html(data.error);
					}
					else
					{	
						window.location.href="appointment.php";
					}
				}
			})

		}

	})

});
</script>
	
	</body>

</html>	

