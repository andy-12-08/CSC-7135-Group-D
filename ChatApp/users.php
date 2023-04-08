<style>
#wrapper {
    display: flex;
    width: -webkit-fill-available !important;
}
</style>


<?php 

  include_once "php/config.php";
  include('../class/Appointment.php');

  $object = new Appointment;
   //$_SESSION['admin_id'];

   $_SESSION['type'];

  if ($_SESSION['type'] =='Admin'){
    $_SESSION['unique_id']='1327219325';
  }else if($_SESSION['type'] =='Doctor'){
 
    $user_id = mysqli_real_escape_string($conn, $_SESSION['admin_id']);
    $sql = mysqli_query($conn, "SELECT a.unique_id,a.email,b.tutor_id,b.tutor_email_address
    from users a, tutor_table b
    where a.user_id =b.tutor_id
    and b.tutor_id = {$user_id} ");
    if(mysqli_num_rows($sql) > 0){
      $row = mysqli_fetch_assoc($sql);
    }

    $_SESSION['unique_id']=$row['unique_id'];
  }else if($_SESSION['type'] =='Student'){

    $_SESSION['type'];
    $user_id= $_SESSION['patient_id'];


    //echo $user_id = mysqli_real_escape_string($conn, $_SESSION['patient_id']);
    $sql = mysqli_query($conn, "SELECT a.unique_id,a.email,b.student_id,b.student_email_address
    from users a, student_table b
    where a.user_id =b.student_id
    and b.student_id = {$user_id}");
    if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
    }

    $_SESSION['unique_id']=$row['unique_id'];
  }





?>
<?php 
if($_SESSION['type'] =='Student'){
  include_once "header.php"; 
  include('../admin/student_header.php');
}

else{
  include_once "header.php"; 
  include('../admin/chat_header.php');
}



?>
<body>

<div class ="main-container">

<div class="wrapper">
    <section class="users">
      <header>
        <div class="content">

          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>

          <img src="../images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. "-" . $row['lname'] ?></span>
            <p><?php echo "Online"; ?></p>
          </div>
        </div>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
</div>
          


</div>


  <script src="javascript/users.js"></script>

</body>
</html>
