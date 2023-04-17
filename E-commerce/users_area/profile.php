 <?php

include("../includes/connection.php");
include("../functions/common_functions.php");

session_start();
  


?>



<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Welcome <?php echo $_SESSION['username'] ?></title>
 <!--bootstrap link-->
 <!-- CSS bootstrap only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
 <!-- font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- css link-->
<link rel="stylesheet" href="style.css">
<style>
body{
 overflow-x: hidden;
 
}
.profile_img{
    width:90%;
    margin:auto;
    display: block;
    /* height:100%; */
    object-fit:contain;

}
.edit_image{
  width: 100px;
  height: 100px;
  object-fit:contain;
  
}
</style> 

 </head>
<body>
 <!--navbar-->
 <div class="container-fluid p-0 ">
     <!--first child--> 
     <nav class="navbar navbar-expand-lg bg-info">
<div class="container-fluid">
  <img src="./images/fast.png" alt="" class="logo">
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarSupportedContent">
   <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     <li class="nav-item">
       <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="../display_all.php">Products</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="profile.php">My profile</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="#">Contact</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php get_cart_item(); ?></sup></a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="#">Total price:<?php total_cart_price(); ?>$</a>
     </li>
      
      
   </ul>
   <form class="d-flex" role="search" action="../search_product.php" method="get">
     <input class="form-control me-2" name='search_data' type="search" placeholder="Search" aria-label="Search">
     <!-- <button class="btn btn-outline-light" type="submit">Search</button> -->
     <input type='submit' value='Search'  class= "btn btn-outline-light" name="search_data_product">
   </form>
 </div>
</div>
</nav>
<!-- calling cart function -->
<?php cart();  ?>
<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">
<?php
 if(isset($_SESSION['username'])){
echo "<li class='nav-item'>
<a href='#' class='nav-link'>Welcome " .$_SESSION['username']."</a>
</li>";
} else{
echo "<li class='nav-item'>
<a href='#' class='nav-link'>Welcome guest</a>
</li>";
}


if(isset($_SESSION['username'])){
echo "<li class='nav-item'>
<a href='./users_area/user_logout.php' class='nav-link'>Logout</a>
</li>";
} else{
echo "<li class='nav-item'>
<a href='./users_area/user_login.php' class='nav-link'>Login</a>
</li>";
}

?>

</ul>
</nav>
<!-- third child-->
<div class="bg-light">
<h3 class="text-center">FASTA FASTA</h3>
<p class="text-center">Delivery FAST </p>
</div>

<div class="row">
  <div class="col-md-2  mb-0">
    <li class="nav-item bg-info">
       <a class="nav-link active text-light"   href="#"><h4>Your profile</h4></a>
       </li>
      
    <ul class="navbar-nav bg-secondary text-center " style='height:100vh'>
      <?php 
      $username=$_SESSION['username'];
      $select_image="select * from `user_table` where username = '$username' ";
      $image_query=mysqli_query($con,$select_image);
      $row_image=mysqli_fetch_array( $image_query);
      $user_image=$row_image['user_image'];
      echo "<li class='nav-item'>
      <img src='./user_images/$user_image' class='profile_img my-4' alt=''>
      </li>
     ";
      ?>
    
       <li class="nav-item  ">
       <a class="nav-link active text-light"   href="profile.php">Pending orders</a>
       </li>
       <li class="nav-item  ">
       <a class="nav-link active text-light"   href="profile.php?edit_account">Edit account</a>
       </li>
       <li class="nav-item  ">
       <a class="nav-link active text-light"   href="profile.php?my_orders">My orders</a>
       </li>
       <li class="nav-item  ">
       <a class="nav-link active text-light"   href="profile.php?delete_account">Delete your account</a>
       </li>
       <li class="nav-item  ">
       <a class="nav-link active text-light"   href="user_logout.php">Logout</a>
       </li>

       </ul>
    </div>
    

    
    <div class="col-md-10">
        <?php get_user_order_details();
        
       if(isset($_GET['edit_account'])){
          include("edit_account.php");
        }
        if(isset($_GET['my_orders'])){
          include("user_orders.php");
        }
        if(isset($_GET['delete_account'])){
          include("delete_account.php");
        }
         ?>
        
    </div>
</div>




 <!--last child-->
<?php include("../includes/footer.php"); ?>
 <!-- bootstrap js link-->
 <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>