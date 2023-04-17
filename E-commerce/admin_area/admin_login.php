<?php 

include('../includes/connection.php');
include('../functions/common_functions.php');
@session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin--login</title>

      <!-- Bootstrap css link -->
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <!-- fontawesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="container-fluid  ">
        <h2 class="text-center m-4">Admin login</h2>
    <div class="row d-flex   justify-content-center align-items-center">
        <div class="col-lg- col-xl-4">
            <img src="../images/admin_reg.jpg" alt="" class="img-fluid">
        </div>
        <div class="col-lg-0 col-xl-5">
          <form action="" method="post" class="w-50 m-auto">
             <div class="form-outline mb-4"> 
                <label for="admin_username" class="form-label">Username</label>
                <input type="text" id="admin_username" name="admin_username" placeholder="Enter your username" required="required" class="form-control">
             </div>
                 
                <div class="form-outline mb-4">  
                 <label for="admin_password" class="form-label">Password</label>
                  <input type="password" id="admin_password" name="admin_password" placeholder="Enter your password" required="required" class="form-control">
                </div>
                 <div>
                  <input type="submit" value="Log in" class="bg-info py-2 px-3 border-0" name="admin_login">
                  <p class="small mt-3 fw-bold ">Don't have an account?<a href="admin_registration.php"> Register</a></p>
                </div>
          </form> 
        </div> 
    </div>
    </div>
</body>
</html>

<!-- php document -->
<?php

if (isset($_POST['admin_login'])) {
    
     $admin_username=$_POST['admin_username'];
     $admin_password=$_POST['admin_password'];
    
     $select_query= "select * from `admin_table` where admin_name = '$admin_username' ";
     $result_query=mysqli_query($con,$select_query);
     $row_count=mysqli_num_rows($result_query);
     $row_data=mysqli_fetch_assoc($result_query);
     
      if($row_count>0){
        $_SESSION['admin_username']=$admin_username;
        if(password_verify($admin_password,$row_data['admin_password'])){
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
           }
            else {
                echo "<script>alert('Invalid credentials')</script>";
               }
               
        
        }
              else{
                echo "<script>alert('Invalid credentials')</script>";
 
         }  
              
        }   
      

?>