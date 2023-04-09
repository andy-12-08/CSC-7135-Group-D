<?php

//appointment_action.php

include('../class/Appointment.php');
include ('../sendemail/mail.php');
$object = new Appointment;

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
		$output = array();

		if($_SESSION['type'] == 'Admin')
		{
			$order_column = array('appointment_table.appointment_number', 'student_table.student_first_name', 'tutor_table.tutor_name', 'tutor_schedule_table.tutor_schedule_date', 'appointment_table.appointment_time', 'tutor_schedule_table.tutor_schedule_day', 'appointment_table.status');
			$main_query = "
			SELECT * FROM appointment_table  
			INNER JOIN tutor_table 
			ON tutor_table.tutor_id = appointment_table.tutor_id 
			INNER JOIN tutor_schedule_table 
			ON tutor_schedule_table.tutor_schedule_id = appointment_table.tutor_schedule_id 
			INNER JOIN student_table 
			ON student_table.student_id = appointment_table.student_id 
			";

			$search_query = '';

			if($_POST["is_date_search"] == "yes")
			{
			 	$search_query .= 'WHERE tutor_schedule_table.tutor_schedule_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND (';
			}
			else
			{
				$search_query .= 'WHERE ';
			}

			if(isset($_POST["search"]["value"]))
			{
				$search_query .= 'appointment_table.appointment_number LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR student_table.student_first_name LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR student_table.student_last_name LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR tutor_table.tutor_name LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR tutor_schedule_table.tutor_schedule_date LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR appointment_table.appointment_time LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR tutor_schedule_table.tutor_schedule_day LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR appointment_table.status LIKE "%'.$_POST["search"]["value"].'%" ';
			}
			if($_POST["is_date_search"] == "yes")
			{
				$search_query .= ') ';
			}
			else
			{
				$search_query .= '';
			}
		}
		else
		{
			$order_column = array('appointment_table.appointment_number', 'student_table.student_first_name', 'tutor_schedule_table.tutor_schedule_date', 'appointment_table.appointment_time', 'tutor_schedule_table.tutor_schedule_day', 'appointment_table.status');

			$main_query = "
			SELECT * FROM appointment_table 
			INNER JOIN tutor_schedule_table 
			ON tutor_schedule_table.tutor_schedule_id = appointment_table.tutor_schedule_id 
			INNER JOIN student_table 
			ON student_table.student_id = appointment_table.student_id 
			";

			$search_query = '
			WHERE appointment_table.tutor_id = "'.$_SESSION["admin_id"].'" 
			';

			if($_POST["is_date_search"] == "yes")
			{
			 	$search_query .= 'AND tutor_schedule_table.tutor_schedule_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" ';
			}
			else
			{
				$search_query .= '';
			}

			if(isset($_POST["search"]["value"]))
			{
				$search_query .= 'AND (appointment_table.appointment_number LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR student_table.student_first_name LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR student_table.student_last_name LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR tutor_schedule_table.tutor_schedule_date LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR appointment_table.appointment_time LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR tutor_schedule_table.tutor_schedule_day LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR appointment_table.status LIKE "%'.$_POST["search"]["value"].'%") ';
			}
		}

		if(isset($_POST["order"]))
		{
			$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_query = 'ORDER BY appointment_table.appointment_id DESC ';
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

			$sub_array[] = $row["student_first_name"] . ' ' . $row["student_last_name"];

			if($_SESSION['type'] == 'Admin')
			{
				$sub_array[] = $row["tutor_name"];
			}
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
				$status = '<span class="badge badge-primary">' . $row["status"] . '</span>';
			}

			if($row["status"] == 'Completed')
			{
				$status = '<span class="badge badge-success">' . $row["status"] . '</span>';
			}

			if($row["status"] == 'Cancel')
			{
				$status = '<span class="badge badge-danger">' . $row["status"] . '</span>';
			}

			$sub_array[] = $status;

			$sub_array[] = '
			<div align="center">
			<button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="'.$row["appointment_id"].'"><i class="fas fa-eye"></i></button>
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

	if($_POST["action"] == 'fetch_single')
	{
		$object->query = "
		SELECT * FROM appointment_table 
		WHERE appointment_id = '".$_POST["appointment_id"]."'
		";

		$appointment_data = $object->get_result();

		foreach($appointment_data as $appointment_row)
		{

			$object->query = "
			SELECT * FROM student_table 
			WHERE student_id = '".$appointment_row["student_id"]."'
			";

			$patient_data = $object->get_result();

			$object->query = "
			SELECT * FROM tutor_schedule_table 
			INNER JOIN tutor_table 
			ON tutor_table.tutor_id = tutor_schedule_table.tutor_id 
			WHERE tutor_schedule_table.tutor_schedule_id = '".$appointment_row["tutor_schedule_id"]."'
			";

			$doctor_schedule_data = $object->get_result();

			$html = '
			<h4 class="text-center">Student Details</h4>
			<table class="table">
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
				<tr>
					<th width="40%" class="text-right">Appointment No.</th>
					<td>'.$appointment_row["appointment_number"].'</td>
				</tr>
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
				
				';
			}

			$html .= '
				<tr>
					<th width="40%" class="text-right">Appointment Time</th>
					<td>'.$appointment_row["appointment_time"].'</td>
				</tr>
				<tr>
					<th width="40%" class="text-right">Reason for Appointment</th>
					<td>'.$appointment_row["reason_for_appointment"].'</td>
				</tr>
			';

			if($appointment_row["status"] != 'Cancel')
			{
				if($_SESSION['type'] == 'Admin')
				{
					if($appointment_row['student_come_into_appointment'] == 'Yes')
					{
						if($appointment_row["status"] == 'Completed')
						{
							$html .= '
								<tr>
									<th width="40%" class="text-right">Appointment Status</th>
									<td>Yes</td>
								</tr>
								<tr>
									<th width="40%" class="text-right">Tutor Comment</th>
									<td>'.$appointment_row["tutor_comment"].'</td>
								</tr>
							';
						}
						else
						{
							$html .= '
								<tr>
									<th width="40%" class="text-right">Appointment Status</th>
									<td>
										<select name="patient_come_into_hospital" id="patient_come_into_hospital" class="form-control" required>
											<option value="">Select</option>
											<option value="Completed" selected>Completed</option>
											<option value="Cancel" >Cancel</option>
										</select>
									</td>
								</tr
							';
						}
					}
					else
					{
						$html .= '
							<tr>
								<th width="40%" class="text-right">Appointment Status</th>
								<td>
									<select name="patient_come_into_hospital" id="patient_come_into_hospital" class="form-control" required>
										<option value="">Select</option>
										<option value="In Process" >In Process</option>
										<option value="Cancel" >Cancel</option>
										<option value="Completed" >Completed</option>
									</select>
								</td>
							</tr>
						';
					}
				}

				if($_SESSION['type'] == 'Doctor')
				{
					//if($appointment_row["student_come_into_appointment"] == 'Yes'){
						if($appointment_row["status"] == 'Completed')
						{
							$html .= '
								<tr>
									<th width="40%" class="text-right">Tutor Comment</th>
									<td>
										<textarea name="doctor_comment" id="doctor_comment" class="form-control" rows="8" required>'.$appointment_row["tutor_comment"].'</textarea>
									</td>
								</tr>
							';
						}
						else
						{
							$html .= '

							<tr>
							<th width="40%" class="text-right">Appointment Status</th>
							<td>
								<select name="patient_come_into_hospital" id="patient_come_into_hospital" class="form-control" required>
									<option value="">Select</option>
									<option value="In Process">In Process</option>
									<option value="Cancel" >Cancel</option>
									<option value="Completed" >Completed</option>
								</select>
							</td>
						</tr>



								<tr>
									<th width="40%" class="text-right">Tutor Comment</th>
									<td>
										<textarea name="doctor_comment" id="doctor_comment" class="form-control" rows="8" required></textarea>
									</td>
								</tr>
							';
						}
					//}
				}
			
			}

			if($appointment_row["status"] == 'Cancel')
			{
				if($_SESSION['type'] == 'Admin')
				{
					
							$html .= '
								<tr>
									<th width="40%" class="text-right">Appointment Status</th>
									<td>
										<select name="patient_come_into_hospital" id="patient_come_into_hospital" class="form-control" required>
										    <option value="">Select</option>
											<option value="In Process">In Process</option>
											<option value="Completed" >Completed</option>
										
										</select>
									</td>
								</tr
							';
						
					
					
				}

				if($_SESSION['type'] == 'Doctor')
				{
					$html .= '
								<tr>
									<th width="40%" class="text-right">Appointment Status</th>
									<td>
										<select name="patient_come_into_hospital" id="patient_come_into_hospital" class="form-control" required>
											<option value="">Select</option>
											<option value="In Process">In Process</option>
											<option value="Completed" >Completed</option>
										</select>
									</td>
								</tr
							';
				}
			
			}



			$html .= '
			</table>
			';
		}

		echo $html;
	}


	if($_POST['action'] == 'change_appointment_status')
	{

		if($_SESSION['type'] == 'Admin')
		{

			$appointment_id = $_POST['hidden_appointment_id'];

			$data = array(
				':status'							=>	$_POST['patient_come_into_hospital'],
				':patient_come_into_hospital'		=>	'Yes',
				':appointment_id'					=>	$_POST['hidden_appointment_id']
			);

			$object->query = "
			UPDATE appointment_table 
			SET status = :status, 
			student_come_into_appointment = :patient_come_into_hospital 
			WHERE appointment_id = :appointment_id
			";

			$object->execute($data);

			echo '<div class="alert alert-success">Appointment Status change to ' . $_POST['patient_come_into_hospital'] . '</div>';
      

				$object->query = "
				select a.appointment_id, a.student_id,b.student_email_address
				from appointment_table a,
				student_table b
				where a.student_id =b.student_id
				and appointment_id = '".$_POST['hidden_appointment_id']."'
				";

				$schedule_data = $object->get_result();

				foreach($schedule_data as $schedule_row)
				{
				$tutor_email_address = $schedule_row["student_email_address"];
				}

				if (confirm_appointment_email($tutor_email_address, $_POST['patient_come_into_hospital'])) {
				$success = 'success';
				} else {
				$error = 'Error sending email: ' . $mail->ErrorInfo;
				}

		
		}

		if($_SESSION['type'] == 'Doctor')
		{

				$data = array(
					':status'							=>	$_POST['patient_come_into_hospital'],
					':appointment_id'					=>	$_POST['hidden_appointment_id']
				);

				$object->query = "
				UPDATE appointment_table 
				SET status = :status
				WHERE appointment_id = :appointment_id
				";

				$object->execute($data);

				echo '<div class="alert alert-success">Appointment'.$_POST['patient_come_into_hospital'].'</div>';

				$object->query = "
				select a.appointment_id, a.student_id,b.student_email_address
				from appointment_table a,
				student_table b
				where a.student_id =b.student_id
				and appointment_id = '".$_POST['hidden_appointment_id']."'
				";

				$schedule_data = $object->get_result();

				foreach($schedule_data as $schedule_row)
				{
				$tutor_email_address = $schedule_row["student_email_address"];
				}

				if (confirm_appointment_email($tutor_email_address, $_POST['patient_come_into_hospital'])) {
				$success = 'success';
				} else {
				$error = 'Error sending email: ' . $mail->ErrorInfo;
				}




		



		}


	}
	

	if($_POST["action"] == 'delete')
	{
		$object->query = "
		DELETE FROM tutor_schedule_table 
		WHERE tutor_schedule_id = '".$_POST["id"]."'
		";

		$object->execute();

		echo '<div class="alert alert-success">Tutor Schedule has been Deleted</div>';
	}



}

?>