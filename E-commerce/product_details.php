<?php

   include("./includes/connection.php");
   include("./functions/common_functions.php");
  
   session_start();
     


?>
  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product details</title>
    <!--bootstrap link-->
    <!-- CSS bootstrap only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- font awesome-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- css link-->
<link rel="stylesheet" href="style.css">
</head>
<body>
        <!--navbar-->
    <div class="container-fluid p-0">
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <?php
         if(isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a href='./users_area/profile.php' class='nav-link'>My account</a>
        </li>";
        } else{
         echo "<li class='nav-item'>
         <a href='./users_area/user_registration.php' class='nav-link'>Register</a>
       </li>";
        }
        
        
        ?>
         <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php get_cart_item(); ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total price:<?php total_cart_price(); ?>$</a>
        </li>
         
         
      </ul>
      <form class="d-flex" role="search" action="search_product.php" method="get">
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

<li class="nav-item">
  <a href="./admin_area/admin_login.php" class="nav-link ">Admin</a>
</li>

  </ul>
</nav>
<div class="row">
  <div class="col-md-4 m-2">

<!--  --><?php
$prod_id=$_GET['product_id'];
$select_query= "Select * from `products` where product_id=$prod_id";
         $result_query= mysqli_query($con,$select_query);
          //$row= mysqli_fetch_assoc($result_query);
         //echo $row['product_title'];
         while ($row= mysqli_fetch_assoc($result_query) ) {
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_image=$row['product_image1'];
         $product_price=$row['product_price'];
         $category_id=$row['category_id'];
         $brand_id=$row['brand_id'];
 
   echo "
  
  <div class='card ' >
         <img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>$product_description</p>
         <p class='card-text'>Price: $product_price$</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-info mx-1  '>Add to cart</a>
         <!-- <a href='product_details.php?product_id=$product_id' class='btn btn-secondary  '>View more</a>           -->
         </div>
         </div>
  ";}
  ?>
  </div>
  <div class="col-md-6">
     <h2 class='text-center text-success text-center mb-4 mt-2'>Product details</h2>
  </div>
</div>
 
</body>
</html>