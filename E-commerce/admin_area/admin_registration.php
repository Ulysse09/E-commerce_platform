<?php 

include('../includes/connection.php');
include('../functions/common_functions.php');



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin--registration</title>

      <!-- Bootstrap css link -->
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <!-- fontawesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="container-fluid  ">
        <h2 class="text-center m-4">Admin registration</h2>
    <div class="row d-flex   justify-content-center align-items-center">
        <div class="col-lg-6 col-xl-5">
            <img src="../images/admin_login.jpg" alt="" class="img-fluid">
        </div>
        <div class="col-lg-6 col-xl-4">
          <form action="" method="post">
             <div class="form-outline mb-4"> 
                <label for="admin_username" class="form-label">Username</label>
                <input type="text" id="admin_username" name="admin_username" placeholder="Enter your username" required="required" class="form-control">
             </div>
                <div class="form-outline mb-4">  
                 <label for="admin_email" class="form-label">E-mail</label>
                  <input type="email" id="admin_email" name="admin_email" placeholder="Enter your E-mail" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">  
                 <label for="admin_password" class="form-label">Password</label>
                  <input type="password" id="admin_password" name="admin_password" placeholder="Enter your password" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">  
                 <label for="conf_admin_password" class="form-label">Confirm Password</label>
                  <input type="password" id="conf_admin_password" name="conf_admin_password" placeholder="Enter your password" required="required" class="form-control">
                </div>
                <div>
                  <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="admin_registration">
                  <p class="small mt-3 fw-bold ">Already have an account?<a href="admin_login.php"> Login</a></p>
                </div>
          </form> 
        </div> 
    </div>
    </div>
</body>
</html>

<!-- php code -->
<?php
 if(isset($_POST['admin_registration'])){

    $admin_username=$_POST['admin_username'];
    $admin_email=$_POST['admin_email'];
    $admin_password=$_POST['admin_password'];
    $hash_password=password_hash($admin_password,PASSWORD_DEFAULT); 
    $conf_admin_password=$_POST['conf_admin_password'];
      
 
// select query
  $select_query= "select * from `admin_table` where admin_name='$admin_username' or admin_email='$admin_email'";
  $result= mysqli_query($con,$select_query);
  $row_count= mysqli_num_rows($result);
   
  if($row_count>0){
    echo "<script>alert('Username or E-mail already exists')</script>";
  }
  elseif ($admin_password!=$conf_admin_password) {
    echo "<script>alert('Passwords do not match')</script>";
     
  }
     else{
// insert query
 
$insert_query= "insert into `admin_table` (admin_name,admin_email,admin_password) values ('$admin_username','$admin_email','$hash_password')";
$sql_execute=mysqli_query($con,$insert_query); 
     } 
     if($sql_execute){
          echo "<script>alert('Admin successfully registered')</script>";
          echo "<script>window.open('./index.php','_self')</script>"; 
       } else{
           die(mysqli_error($con));
       }
 
    }