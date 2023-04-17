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
    <title>E-commerce--Registration</title>
     <!--bootstrap link-->
     <!-- CSS bootstrap only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      
<!-- css link-->
</head>
<body>
    <div class="container-fluid  ">
        <h2 class="text-center">User registration</h2>
        <div class="row d-flex   justify-content-center ">
         <div class="col-xl-5">
            <img src="../images/user_signup.jpg" alt="" class="img-fluid">
         </div>    
        
          <div class="col-lg-12 col-xl-4 my-4"> 
                <form action="" enctype='multipart/form-data' method="post" >
                    <!-- username field -->
                     <div class="form-outline mb-4">
                        <label for="user_username" class='form-label'>Username</bel>
                        <input type="text" name="user_username" id="user_username" class="form-control" autocomplete='off' placeholder="Enter your Username" required>
                    </div>
                    <!-- email field -->
                    <div class="form-outline mb-4 ">
                        <label for="user_email" class='form-label'>E-mail</bel>
                        <input type="email" id='user_email' class='form-control' placeholder='Enter your e-mail' autocomplete='off' required='required' name='user_email'/>
                    </div>
                    <!-- image field -->
                    <div class="form-outline mb-4 ">
                        <label for="user_image" class='form-label'>User image</bel>
                        <input type="file" id='user_image' class='form-control'   required='required' name='user_image'/>
                    </div>
                    <!-- password field -->
                    <div class="form-outline mb-4 ">
                        <label for="user_password" class='form-label'>Password</bel>
                        <input type="password" id='user_password' class='form-control' placeholder='Enter your password' autocomplete='off' required='required' name='user_password'/>
                    </div>
                    <!-- confirm password field -->
                    <div class="form-outline mb-4 ">
                        <label for="conf_user_password" class='form-label'>Confirm Password</bel>
                        <input type="password" id='conf_user_password' class='form-control' placeholder='Confirm Password' autocomplete='off' required='required' name='conf_user_password'/>
                    </div>
                    <!-- Address field -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class='form-label'>Address</bel>
                        <input type="text" name="user_address" id="user_address" class="form-control" autocomplete='off' placeholder="Enter your Address" required>
                    </div>
                    <!-- Contact field -->
                    <div class="form-outline  mb-4">
                        <label for="user_contact" class='form-label'>Contact</bel>
                        <input type="text" name="user_contact" id="user_contact" class="form-control " autocomplete='off' placeholder="Enter your contact" required>
                    </div>
                    <div class="  ">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="mt-3 small">Already have an account?<a href="user_login.php"> Login</a></p>
                    </div>




                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- php code -->
<?php
 if(isset($_POST['user_register'])){

    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT); 
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();
 
// select query
  $select_query= "select * from `user_table` where username='$user_username' or user_email='$user_email'";
  $result= mysqli_query($con,$select_query);
  $row_count= mysqli_num_rows($result);
   
  if($row_count>0){
    echo "<script>alert('Username or E-mail already exists')</script>";
  }
  elseif ($user_password!=$conf_user_password) {
    echo "<script>alert('Passwords do not match')</script>";
     
  }
     else{
// insert query
move_uploaded_file($user_image_tmp,"./user_images/$user_image");
$insert_query= "insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile) values ( '$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address', '$user_contact')";
$sql_execute=mysqli_query($con,$insert_query); 
     } 
// if($sql_execute){
//     echo "<script>alert('Data inserted successfully')</script>"; 
// } else{
//     die(mysqli_error($con));
// }

// selecting cart items 

$select_cart_items="select * from `cart_details` where ip_address= '$user_ip'";
$result_cart=mysqli_query($con,$select_cart_items);
$rows_count=mysqli_num_rows($result_cart);
if($rows_count>0){
    $_SESSION['username']=$user_username;
    echo "<script>alert('You have items in your cart')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";
} else{
      echo  "<script>window.open('../index.php','_self')</script>";

    }



}  
 ?>