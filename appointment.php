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
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Rating</th>
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
    var appointment_status = $(this).data('status');
    var tutor_id = $(this).data('tutor_id');
    var student_id = $(this).data('student_id');


    if(appointment_status == "Completed")
    {
        var rating = prompt("Please enter a rating (1-5):", "");
        if (rating !== null && !isNaN(rating) && rating >= 1 && rating <= 5) {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{appointment_id:appointment_id, action:'cancel_appointment', rating: rating,tutor_id:tutor_id,student_id:student_id},
                success:function(data)
                {
                    $('#message').html(data);
                    dataTable.ajax.reload();
                    setTimeout(function(){
                        $('#message').html('');
                    }, 5000);
                }
            });
        } else {
            alert("Invalid rating. Please enter a number between 1 and 5.");
        }
    } else{
      alert("You can not rate your professor, Appointment is not Completed ");
    }
});





});

</script>
	
	
</body>

</html>	
	
	
	
	
	
	