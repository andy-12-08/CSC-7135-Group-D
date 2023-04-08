<?php
include('class/Appointment.php');
$student_first_name = "";
$student_last_name = "";
$email_address = "";
$student_phone_no = "";
$student_subject = "";
$student_profile_image = "";
$student_address = "";
$student_password = "";
$object = new Appointment;
$object->query = "
SELECT * FROM student_table 
WHERE student_id = '".$_SESSION["patient_id"]."'
";
$result = $object->get_result();

// Check if there are any records in the result
if ($result->rowCount() > 0) {
    // Loop through the result set and display each row
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
         $student_first_name = $row["student_first_name"];
		 $student_last_name = $row["student_last_name"];
		 $email_address = $row["student_email_address"];
		 $student_contact_no = $row["student_phone_no"];
		 $student_department = $row["student_maritial_status"];
		 $student_address = $row["student_address"];
		 $student_address = str_replace(array("\r", "\n"), array('\r', '\n'), $row["student_address"]);
	

    }
} else {
    echo "No records found";
}
	
include('student_header.php');
?>

	

<form method="post" id="profile_form" enctype="multipart/form-data">
                        <div class="row"><div class="col-md-8"><span id="message"></span><div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                                    </div>
                                    <div clas="col" align="right">
                                        <input type="hidden" name="action" value="student_profile" />
                                        <button type="submit" name="edit_button" id="edit_button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        &nbsp;&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!--<div class="row">
                                    <div class="col-md-6">!-->
                                        <div class="form-group">
                                            <label>Student First Name</label>
                                            <input type="text" name="student_first_name" id="student_first_name" class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-maxlength="175" data-parsley-trigger="keyup" />
                                        </div>

										<div class="form-group">
                                            <label>Student Last Name</label>
                                            <input type="text" name="student_last_name" id="student_last_name" 
											class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-maxlength="175" data-parsley-trigger="keyup" />
                                        </div>


                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="text" name="email_address" id="email_address" class="form-control" required  data-parsley-type="email" data-parsley-trigger="keyup" />
                                        </div>
                                    
                                
                                        <div class="form-group">
                                            <label> Address</label>
                                            <textarea name="student_address" id="student_address" class="form-control" required ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label> Contact No.</label>
                                            <input type="text" name="student_contact_no" id="student_contact_no" class="form-control" required  data-parsley-trigger="keyup" />
                                        </div>

										<div class="form-group">
                                            <label> Department</label>
                                            <input type="text" name="student_department" id="student_department" class="form-control" required  data-parsley-trigger="keyup" />
                                        </div>

                                        <div class="form-group">
                                            <label>Student Picture</label><br />
                                            <input type="file" name="admin_logo" id="admin_logo" />
                                            <span id="uploaded_admin_logo"></span>
                                        </div>
                                    <!--</div>
                                </div>!-->
                            </div>
                        </div></div></div>
                    </form>



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


document.getElementById('student_first_name').value = "<?php echo $student_first_name; ?>";
document.getElementById('student_last_name').value = "<?php echo $student_last_name; ?>";
document.getElementById('email_address').value = "<?php echo $email_address; ?>";
document.getElementById('student_last_name').value = "<?php echo $student_last_name; ?>";
document.getElementById('student_contact_no').value = "<?php echo $student_contact_no; ?>";
document.getElementById('student_address').value = "<?php echo $student_address; ?>";
document.getElementById('student_department').value = "<?php echo $student_department; ?>";


<?php
        if($row['admin_logo'] != '')
        {
    ?>
    $("#uploaded_admin_logo").html("<img src='<?php echo $row["admin_logo"]; ?>' class='img-thumbnail' width='100' /><input type='hidden' name='hidden_admin_logo' value='<?php echo $row['admin_logo']; ?>' />");

    <?php
        }
        else
        {
    ?>
    $("#uploaded_admin_logo").html("<input type='hidden' name='hidden_admin_logo' value='' />");
    <?php
        }
?>


    $('#profile_form').parsley();
	$('#profile_form').on('submit', function(event){
		event.preventDefault();
			var formData = new FormData(this);
            console.log('Form data:', formData); // Add this line

		if($('#profile_form').parsley().isValid())
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

	$('#profile_form').on('submit', function(event){


		  event.preventDefault();
		if($('#profile_form').parsley().isValid())
		{	
			
			var formData = new FormData(this);

// Log key-value pairs in the FormData object
			formData.forEach((value, key) => {
				console.log(`${key}: ${value}`);
			});

			$.ajax({
				url:"action.php",
				method:"POST",
				data: formData,
                dataType:'json',
                contentType:false,
                processData:false,
				beforeSend:function()
				{
					$('#edit_button').attr('disabled', 'disabled');
					$('#edit_button').html('wait...');
				},
				success:function(data)
				{
					$('#edit_button').attr('disabled', false);
                    $('#edit_button').html('<i class="fas fa-edit"></i> Edit');

                    if(data.error != '')
                    {
                        $('#message').html(data.error);
                    }
                    else
                    {
						window.location.href = "profile.php";
                       
                    }
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