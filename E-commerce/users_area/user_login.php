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
    <title>E-commerce--Registration</title>
     <!--bootstrap link-->
     <!-- CSS bootstrap only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      
<!-- css link-->
</head>
<body>
    <div class="container-fluid  ">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center  ">
        <div class="col-xl-5">
            <img src="../images/admin_login.jpg" alt="" class="img-fluid">
         </div> 
           <div class="col-lg-12 col-xl-4 px-4 mx-4"> 
                <form action="" enctype='multipart/form-data' method="post" >
                    <!-- username field -->
                     <div class="form-outline mb-3">
                        <label for="user_username" class='form-label'>Username</bel>
                        <input type="text" name="user_username" id="user_username" class="form-control" autocomplete='off' placeholder="Enter your Username" required>
                    </div>
                     <!-- password field -->
                    <div class="form-outline mb-4 ">
                        <label for="user_password" class='form-label'>Password</bel>
                        <input type="password" id='user_password' class='form-control' placeholder='Enter your password' autocomplete='off' required='required' name='user_password'/>
                    </div>
 
                    <div class="  ">
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                        <p class="mt-3 small">Don't have an account?<a href="user_registration.php"> Register now</a></p>
                    </div>

                </form>
            </div>

               
        

        </div>
    </div>
</body>
</html>

<?php

if (isset($_POST['user_login'])) {
    
     $user_username=$_POST['user_username'];
     $user_password=$_POST['user_password'];
    
     $select_query= "select * from `user_table` where username = '$user_username' ";
     $result_query=mysqli_query($con,$select_query);
     $row_count=mysqli_num_rows($result_query);
     $row_data=mysqli_fetch_assoc($result_query);
     
     $user_ip=getIPAddress();
     
     // cart item
     $select_query_cart= "select * from `cart_details` where ip_address = '$user_ip' ";
     $select_cart= mysqli_query($con,$select_query_cart);
     $row_count_cart=mysqli_num_rows($select_cart);



     if($row_count>0){
        $_SESSION['username']=$user_username;
        if(password_verify($user_password,$row_data['user_password'])){
           if($row_count==1 and $row_count_cart>0){
            $_SESSION['username']=$user_username;
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('payment.php','_self')</script>";
           }
             else{
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
                
             }
         }  
            else{
               echo "<script>alert('Invalid credentials')</script>";

            }  
        }   
      else{
        echo "<script>alert('Invalid credentials')</script>";
     }
     }

?>