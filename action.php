<?php
ob_start();
//action.php

include('class/Appointment.php');
include ('sendemail/mail.php');
$object = new Appointment;

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'check_login')
	{
		if(isset($_SESSION['patient_id']))
		{
			echo 'dashboard.php';
		}
		else
		{
			echo 'login.php';
		}
	}

	if($_POST['action'] == 'patient_register')
	{
		$error = '';
		$success = '';
		$data = array(
			':patient_email_address'	=>	$_POST["patient_email_address"]
		);
		$object->query = "
		SELECT * FROM student_table 
		WHERE student_email_address = :patient_email_address
		";


		$password =$_POST["patient_password"];
		$options = [
            'memory_cost' => 1<<17,
            'time_cost' => 4,
            'threads' => 2,
            ];
        $hash = password_hash($password,  PASSWORD_ARGON2I, $options);



		$object->execute($data);

		if($object->row_count() > 0)
		{
			$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
		}
		else
		{
			$patient_verification_code = md5(uniqid());
			$data = array(
				':patient_email_address'		=>	$object->clean_input($_POST["patient_email_address"]),
				':patient_password'				=>	$hash,
				':patient_first_name'			=>	$object->clean_input($_POST["patient_first_name"]),
				':patient_last_name'			=>	$object->clean_input($_POST["patient_last_name"]),
				':patient_date_of_birth'		=>	$object->clean_input($_POST["patient_date_of_birth"]),
				':patient_gender'				=>	$object->clean_input($_POST["patient_gender"]),
				':patient_address'				=>	$object->clean_input($_POST["patient_address"]),
				':patient_phone_no'				=>	$object->clean_input($_POST["patient_phone_no"]),
				':patient_maritial_status'		=>	$object->clean_input($_POST["patient_maritial_status"]),
				':patient_added_on'				=>	$object->now,
				':patient_verification_code'	=>	$patient_verification_code,
				':email_verify'					=>	'No'
			);

			$object->query = "
			INSERT INTO student_table 
			(student_email_address, student_password, student_first_name, student_last_name, student_date_of_birth, student_gender, student_address, student_phone_no, student_maritial_status, student_added_on, student_verification_code, email_verify)
			VALUES (:patient_email_address, :patient_password, :patient_first_name, :patient_last_name, :patient_date_of_birth, :patient_gender, :patient_address, :patient_phone_no, :patient_maritial_status, :patient_added_on, :patient_verification_code, :email_verify)
			";

			$object->execute($data);



		if (send_email($_POST["patient_email_address"], $_POST["patient_first_name"])) {
		            $success = 'success';
		} else {
		           $error = 'Error sending email: ' . $mail->ErrorInfo;
		}


		}

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
			
		);
		
		ob_clean();
		echo json_encode($output);
	}

	
	
	if($_POST['action'] == 'patient_login')
	{
		$error = '';

		$data = array(
			':patient_email_address'	=>	$_POST["patient_email_address"]
		);

		$object->query = "
		SELECT * FROM student_table 
		WHERE student_email_address = :patient_email_address
		";

		$object->execute($data);

		if($object->row_count() > 0)
		{

			$result = $object->statement_result();

			foreach($result as $row)
			{
				if($row["email_verify"] == 'Yes')
				{
					//if($row["student_password"] == $_POST["patient_password"])

					if (password_verify($_POST["patient_password"], $row["student_password"]))
					{
						$_SESSION['patient_id'] = $row['student_id'];
						$_SESSION['patient_name'] = $row['student_first_name'] . ' ' . $row['student_last_name'];
					}




					else
					{
						$error = '<div class="alert alert-danger">Wrong Password</div>';
					}
				}
				else
				{
					$error = '<div class="alert alert-danger">Please first verify your email address</div>';
				}
			}
		}
		else
		{
			$error = '<div class="alert alert-danger">Wrong Email Address</div>';
		}

		$output = array(
			'error'		=>	$error
		);

		echo json_encode($output);

	}

	
	
	
	if($_POST['action'] == 'fetch_schedule')
	{
		$output = array();

		$order_column = array('tutor_table.tutor_name', 'tutor_table.tutor_degree', 'tutor_table.tutor_expert_in',
		 'tutor_schedule_table.tutor_schedule_date', 'tutor_schedule_table.tutor_schedule_day', 'tutor_schedule_table.tutor_schedule_start_time');
		
		$main_query = "
		SELECT * FROM tutor_schedule_table 
		INNER JOIN tutor_table 
		ON tutor_table.tutor_id = tutor_schedule_table.tutor_id 
		";

		$search_query = '
		WHERE tutor_schedule_table.tutor_schedule_date >= "'.date('Y-m-d').'" 
		AND tutor_schedule_table.tutor_schedule_status = "Active" 
		AND tutor_table.tutor_status = "Active" 
		';

		if(isset($_POST["search"]["value"]))
		{
			$search_query .= 'AND ( tutor_table.tutor_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR tutor_table.tutor_degree LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR tutor_table.tutor_expert_in LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR tutor_schedule_table.tutor_schedule_date LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR tutor_schedule_table.tutor_schedule_day LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR tutor_schedule_table.tutor_schedule_start_time LIKE "%'.$_POST["search"]["value"].'%") ';
		}
		
		if(isset($_POST["order"]))
		{
			$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_query = 'ORDER BY tutor_schedule_table.tutor_schedule_date ASC ';
		}

		$limit_query = '';

		if($_POST["length"] != -1)
		{
			$limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$object->query = $main_query . $search_query . $order_query;

		$object->execute();

		$filtered_rows = $object->row_count();

		$object->query .= $limit_query;

		$result = $object->get_result();

		$object->query = $main_query . $search_query;

		$object->execute();

		$total_rows = $object->row_count();

		$data = array();

		foreach($result as $row)
		{
			$sub_array = array();

			$sub_array[] = $row["tutor_name"];

			$sub_array[] = $row["tutor_degree"];

			$sub_array[] = $row["tutor_expert_in"];

			$sub_array[] = $row["tutor_schedule_date"];

			$sub_array[] = $row["tutor_schedule_day"];

			$sub_array[] = $row["tutor_schedule_start_time"];

			$sub_array[] = '
			<div align="center">
			<button type="button" name="get_appointment" class="btn btn-success btn-sm get_appointment" data-doctor_id="'.$row["tutor_id"].'" data-doctor_schedule_id="'.$row["tutor_schedule_id"].'">Get Appointment</button>
			</div>
			';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"    			=> 	intval($_POST["draw"]),
			"recordsTotal"  	=>  $total_rows,
			"recordsFiltered" 	=> 	$filtered_rows,
			"data"    			=> 	$data
		);
			
		echo json_encode($output);
	}

	if($_POST['action'] == 'edit_profile')
	{
		$data = array(
			':patient_password'			=>	$_POST["patient_password"],
			':patient_first_name'		=>	$_POST["patient_first_name"],
			':patient_last_name'		=>	$_POST["patient_last_name"],
			':patient_date_of_birth'	=>	$_POST["patient_date_of_birth"],
			':patient_gender'			=>	$_POST["patient_gender"],
			':patient_address'			=>	$_POST["patient_address"],
			':patient_phone_no'			=>	$_POST["patient_phone_no"],
			':patient_maritial_status'	=>	$_POST["patient_maritial_status"]
		);

		$object->query = "
		UPDATE patient_table  
		SET patient_password = :patient_password, 
		patient_first_name = :patient_first_name, 
		patient_last_name = :patient_last_name, 
		patient_date_of_birth = :patient_date_of_birth, 
		patient_gender = :patient_gender, 
		patient_address = :patient_address, 
		patient_phone_no = :patient_phone_no, 
		patient_maritial_status = :patient_maritial_status 
		WHERE patient_id = '".$_SESSION['patient_id']."'
		";

		$object->execute($data);

		$_SESSION['success_message'] = '<div class="alert alert-success">Profile Data Updated</div>';

		echo 'done';
	}

	if($_POST['action'] == 'make_appointment')
	{
		$object->query = "
		SELECT * FROM student_table 
		WHERE student_id = '".$_SESSION["patient_id"]."'
		";

		$patient_data = $object->get_result();

		$object->query = "
		SELECT * FROM tutor_schedule_table 
		INNER JOIN tutor_table 
		ON tutor_table.tutor_id = tutor_schedule_table.tutor_id 
		WHERE tutor_schedule_table.tutor_schedule_id = '".$_POST["doctor_schedule_id"]."'
		";

		$doctor_schedule_data = $object->get_result();

		$html = '
		<h4 class="text-center">Student Details</h4>
		<table class="table align-items-center mb-0s">
		';

		foreach($patient_data as $patient_row)
		{
			$html .= '
			<tr>
				<th width="40%" class="text-right">Student Name</th>
				<td>'.$patient_row["student_first_name"].' '.$patient_row["student_last_name"].'</td>
			</tr>
			<tr>
				<th width="40%" class="text-right">Contact No.</th>
				<td>'.$patient_row["student_phone_no"].'</td>
			</tr>
			<tr>
				<th width="40%" class="text-right">Address</th>
				<td>'.$patient_row["student_address"].'</td>
			</tr>
			';
		}

		$html .= '
		</table>
		<hr />
		<h4 class="text-center">Appointment Details</h4>
		<table class="table">
		';
		foreach($doctor_schedule_data as $doctor_schedule_row)
		{
			$html .= '
			<tr>
				<th width="40%" class="text-right">Tutor Name</th>
				<td>'.$doctor_schedule_row["tutor_name"].'</td>
			</tr>
			<tr>
				<th width="40%" class="text-right">Appointment Date</th>
				<td>'.$doctor_schedule_row["tutor_schedule_date"].'</td>
			</tr>
			<tr>
				<th width="40%" class="text-right">Appointment Day</th>
				<td>'.$doctor_schedule_row["tutor_schedule_day"].'</td>
			</tr>
			<tr>
				<th width="40%" class="text-right">Available Time</th>
				<td>'.$doctor_schedule_row["tutor_schedule_start_time"].' - '.$doctor_schedule_row["tutor_schedule_end_time"].'</td>
			</tr>
			';
		}

		$html .= '
		</table>';
		echo $html;
	}

	if($_POST['action'] == 'book_appointment')
	{
		$error = '';
		$data = array(
			':patient_id'			=>	$_SESSION['patient_id'],
			':doctor_schedule_id'	=>	$_POST['hidden_doctor_schedule_id']
		);

		$object->query = "
		SELECT * FROM appointment_table 
		WHERE student_id = :patient_id 
		AND tutor_schedule_id = :doctor_schedule_id
		";

		$object->execute($data);

		if($object->row_count() > 0)
		{
			$error = '<div class="alert alert-danger">You have already applied for appointment for this day, try for other day.</div>';
		}
		else
		{
			$object->query = "
			SELECT * FROM tutor_schedule_table 
			WHERE tutor_schedule_id = '".$_POST['hidden_doctor_schedule_id']."'
			";

			$schedule_data = $object->get_result();

			$object->query = "
			SELECT COUNT(appointment_id) AS total FROM appointment_table 
			WHERE tutor_schedule_id = '".$_POST['hidden_doctor_schedule_id']."' 
			";

			$appointment_data = $object->get_result();

			$total_doctor_available_minute = 0;
			$average_consulting_time = 0;
			$total_appointment = 0;

			foreach($schedule_data as $schedule_row)
			{
				$end_time = strtotime($schedule_row["tutor_schedule_end_time"] . ':00');

				$start_time = strtotime($schedule_row["tutor_schedule_start_time"] . ':00');

				$total_doctor_available_minute = ($end_time - $start_time) / 60;

				$average_consulting_time = $schedule_row["average_consulting_time"];
			}

			foreach($appointment_data as $appointment_row)
			{
				$total_appointment = $appointment_row["total"];
			}

			$total_appointment_minute_use = $total_appointment * $average_consulting_time;

			$appointment_time = date("H:i", strtotime('+'.$total_appointment_minute_use.' minutes', $start_time));

			$status = '';

			$appointment_number = $object->Generate_appointment_no();

			if(strtotime($end_time) > strtotime($appointment_time . ':00'))
			{
				$status = 'Booked';
			}
			else
			{
				$status = 'Waiting';
			}
			
			$data = array(
				':doctor_id'				=>	$_POST['hidden_doctor_id'],
				':patient_id'				=>	$_SESSION['patient_id'],
				':doctor_schedule_id'		=>	$_POST['hidden_doctor_schedule_id'],
				':appointment_number'		=>	$appointment_number,
				':reason_for_appointment'	=>	$_POST['reason_for_appointment'],
				':appointment_time'			=>	$appointment_time,
				':status'					=>	'Booked'
			);

			$object->query = "
			INSERT INTO appointment_table 
			(tutor_id, student_id, tutor_schedule_id, appointment_number, reason_for_appointment, appointment_time, status) 
			VALUES (:doctor_id, :patient_id, :doctor_schedule_id, :appointment_number, :reason_for_appointment, :appointment_time, :status)
			";

			$object->execute($data);

			$_SESSION['appointment_message'] = '<div class="alert alert-success">Your Appointment has been <b>'.$status.'</b> with Appointment No. <b>'.$appointment_number.'</b></div>';
		}
		echo json_encode(['error' => $error]);
		
	}

	if($_POST['action'] == 'fetch_appointment')
	{
		$output = array();

		$order_column = array('appointment_table.appointment_number','tutor_table.tutor_name', 
		'tutor_schedule_table.tutor_schedule_date', 'appointment_table.appointment_time', 'tutor_schedule_table.tutor_schedule_day', 
		'appointment_table.status');
		
		$main_query = "
		SELECT * FROM appointment_table  
		INNER JOIN tutor_table 
		ON tutor_table.tutor_id = appointment_table.tutor_id 
		INNER JOIN tutor_schedule_table 
		ON tutor_schedule_table.tutor_schedule_id = appointment_table.tutor_schedule_id 
		
		";

		$search_query = '
		WHERE appointment_table.student_id = "'.$_SESSION["patient_id"].'" 
		';

		if(isset($_POST["search"]["value"]))
		{
			$search_query .= 'AND ( appointment_table.appointment_number LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR tutor_table.tutor_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR tutor_schedule_table.tutor_schedule_date LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR appointment_table.appointment_time LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR tutor_schedule_table.tutor_schedule_day LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR appointment_table.status LIKE "%'.$_POST["search"]["value"].'%") ';
		}
		
		if(isset($_POST["order"]))
		{
			$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_query = 'ORDER BY appointment_table.appointment_id ASC ';
		}

		$limit_query = '';

		if($_POST["length"] != -1)
		{
			$limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$object->query = $main_query . $search_query . $order_query;

		$object->execute();

		$filtered_rows = $object->row_count();

		$object->query .= $limit_query;

		$result = $object->get_result();

		$object->query = $main_query . $search_query;

		$object->execute();

		$total_rows = $object->row_count();

		$data = array();

		foreach($result as $row)
		{
			$sub_array = array();

			$sub_array[] = $row["appointment_number"];

			$sub_array[] = $row["tutor_name"];

			$sub_array[] = $row["tutor_schedule_date"];			

			$sub_array[] = $row["appointment_time"];

			$sub_array[] = $row["tutor_schedule_day"];

			$status = '';

			if($row["status"] == 'Booked')
			{
				$status = '<span class="badge badge-warning">' . $row["status"] . '</span>';
			}

			if($row["status"] == 'In Process')
			{
				$status = '<span class="badge badge-primary" style="color:green!important;">' . $row["status"] . '</span>';
			}

			if($row["status"] == 'Completed')
			{
				$status = '<span class="badge badge-success" style="color:#4CAF50!important;">' . $row["status"] .'</span>';
			}

			if($row["status"] == 'Cancel')
			{
				$status = '<span class="badge badge-danger">' . $row["status"] . '</span>';
			}

			$sub_array[] = $status;

			$sub_array[] = '<button type="button" name="cancel_appointment" class="btn btn-danger btn-sm cancel_appointment" data-id="' . $row["appointment_id"] . '" data-status="' . $row["status"] . '" data-tutor_id="' . $row["tutor_id"] . '" data-student_id="' . $row["student_id"] . '"><i class="fas fa-times"></i></button>';


			$data[] = $sub_array;
		}

		$output = array(
			"draw"    			=> 	intval($_POST["draw"]),
			"recordsTotal"  	=>  $total_rows,
			"recordsFiltered" 	=> 	$filtered_rows,
			"data"    			=> 	$data
		);
			
		echo json_encode($output);
	}

	if($_POST['action'] == 'cancel_appointment')
	{
		$data = array(
			':appointment_id'	=>	$_POST['appointment_id'],
			':rating'	        =>	$_POST['rating'],
			':tutor_id'	        =>	$_POST['tutor_id'],
			':student_id'	    =>	$_POST['student_id']
		);

		$object->query = "
			INSERT INTO tutor_rating 
			(tutor_id, student_id, appointment_id, rating) 
			VALUES (:tutor_id, :student_id, :appointment_id, :rating)
			";

		$object->execute($data);
		echo '<div class="alert alert-success">Tutor Rating is added.</div>';

	}
}



?>