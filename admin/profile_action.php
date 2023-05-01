<?php

include('../class/Appointment.php');

$object = new Appointment;

if($_POST["action"] == 'doctor_profile')
{


	sleep(2);

	$error = '';

	$success = '';

	$doctor_profile_image = '';
	
	$data = array(
		':doctor_email_address'	=>	$_POST["doctor_email_address"],
		':doctor_id'			=>	$_POST['hidden_id']
	);

	$object->query = "
	SELECT * FROM tutor_table 
	WHERE tutor_email_address = :doctor_email_address 
	AND tutor_id != :doctor_id
	";

	$object->execute($data);

	if($object->row_count() > 0)
	{
		$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
	}
	else
	{
		$doctor_profile_image = $_POST["hidden_doctor_profile_image"];

		if($_FILES['doctor_profile_image']['name'] != '')
		{
			$allowed_file_format = array("jpg", "png");

	    	$file_extension = pathinfo($_FILES["doctor_profile_image"]["name"], PATHINFO_EXTENSION);

	    	if(!in_array($file_extension, $allowed_file_format))
		    {
		        $error = "<div class='alert alert-danger'>Upload valiid file. jpg, png</div>";
		    }
		    else if (($_FILES["doctor_profile_image"]["size"] > 2000000))
		    {
		       $error = "<div class='alert alert-danger'>File size exceeds 2MB</div>";
		    }
		    else
		    {
		    	$new_name = rand() . '.' . $file_extension;

				$destination = '../images/' . $new_name;

				move_uploaded_file($_FILES['doctor_profile_image']['tmp_name'], $destination);

				$doctor_profile_image = $destination;
		    }
		}

		if($error == '')
		{
			$data = array(
				':doctor_email_address'			=>	$object->clean_input($_POST["doctor_email_address"]),
				':doctor_password'				=>	$_POST["doctor_password"],
				':doctor_name'					=>	$object->clean_input($_POST["doctor_name"]),
				':doctor_profile_image'			=>	$doctor_profile_image,
				':doctor_phone_no'				=>	$object->clean_input($_POST["doctor_phone_no"]),
				':doctor_address'				=>	$object->clean_input($_POST["doctor_address"]),
				':doctor_date_of_birth'			=>	$object->clean_input($_POST["doctor_date_of_birth"]),
				':doctor_degree'				=>	$object->clean_input($_POST["doctor_degree"]),
				':doctor_expert_in'				=>	$object->clean_input($_POST["doctor_expert_in"])
			);

			$object->query = "
			UPDATE tutor_table  
			SET tutor_email_address = :doctor_email_address, 
			tutor_password = :doctor_password, 
			tutor_name = :doctor_name, 
			tutor_profile_image = :doctor_profile_image, 
			tutor_phone_no = :doctor_phone_no, 
			tutor_address = :doctor_address, 
			tutor_date_of_birth = :doctor_date_of_birth, 
			tutor_degree = :doctor_degree,  
			tutor_expert_in = :doctor_expert_in 
			WHERE tutor_id = '".$_POST['hidden_id']."'
			";
			$object->execute($data);



			

			$success = '<div class="alert alert-success">Tutor Data Updated</div>';
		}			
	}

	$output = array(
		'error'					=>	$error,
		'success'				=>	$success,
		'tutor_email_address'	=>	$_POST["doctor_email_address"],
		'tutor_password'		=>	$_POST["doctor_password"],
		'tutor_name'			=>	$_POST["doctor_name"],
		'tutor_profile_image'	=>	$doctor_profile_image,
		'tutor_phone_no'		=>	$_POST["doctor_phone_no"],
		'tutor_address'		    =>	$_POST["doctor_address"],
		'tutor_date_of_birth'	=>	$_POST["doctor_date_of_birth"],
		'tutor_degree'			=>	$_POST["doctor_degree"],
		'tutor_expert_in'		=>	$_POST["doctor_expert_in"],
	);

	echo json_encode($output);
}

if($_POST["action"] == 'admin_profile')
{
	sleep(2);

	$error = '';

	$success = '';

	$admin_logo = $_POST['hidden_admin_logo'];

	if($_FILES['admin_logo']['name'] != '')
	{
		$allowed_file_format = array("jpg", "png");

	    $file_extension = pathinfo($_FILES["admin_logo"]["name"], PATHINFO_EXTENSION);

	    if(!in_array($file_extension, $allowed_file_format))
		{
		    $error = "<div class='alert alert-danger'>Upload valiid file. jpg, png</div>";
		}
		else if (($_FILES["admin_logo"]["size"] > 2000000))
		{
		   $error = "<div class='alert alert-danger'>File size exceeds 2MB</div>";
	    }
		else
		{
		    $new_name = rand() . '.' . $file_extension;

			$destination = '../images/' . $new_name;

			move_uploaded_file($_FILES['admin_logo']['tmp_name'], $destination);

			$admin_logo = $destination;
		}
	}

	if($error == '')
	{
		$data = array(
			':admin_email_address'			=>	$object->clean_input($_POST["admin_email_address"]),
			':admin_password'				=>	$_POST["admin_password"],
			':admin_name'					=>	$object->clean_input($_POST["admin_name"]),
			':uni_name'				        =>	$object->clean_input($_POST["uni_name"]),
			':uni_address'				    =>	$object->clean_input($_POST["uni_address"]),
			':admin_contact_no'			    =>	$object->clean_input($_POST["admin_contact_no"]),
			':admin_logo'				    =>	$admin_logo
		);

		$object->query = "
		UPDATE admin_table  
		SET admin_email_address = :admin_email_address, 
		admin_password = :admin_password, 
		admin_name = :admin_name, 
		uni_name = :uni_name, 
		uni_address = :uni_address, 
		admin_contact_no = :admin_contact_no, 
		admin_logo = :admin_logo 
		WHERE admin_id = '".$_SESSION["admin_id"]."'
		";
		$object->execute($data);

		$success = '<div class="alert alert-success">Admin Data Updated</div>';

		$output = array(
			'error'					=>	$error,
			'success'				=>	$success,
			'admin_email_address'	=>	$_POST["admin_email_address"],
			'admin_password'		=>	$_POST["admin_password"],
			'admin_name'			=>	$_POST["admin_name"], 
			'uni_name'			    =>	$_POST["uni_name"],
			'uni_address'		    =>	$_POST["uni_address"],
			'admin_contact_no'	    =>	$_POST["admin_contact_no"],
			'admin_logo'			=>	$admin_logo
		);

		echo json_encode($output);
	}
	else
	{
		$output = array(
			'error'					=>	$error,
			'success'				=>	$success
		);
		echo json_encode($output);
	}
}

?>