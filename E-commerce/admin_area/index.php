<?php

   include("../includes/connection.php");
 //  include("../functions/common_functions.php");
  
   session_start();
     


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <!-- Bootstrap css link -->
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <!-- fontawesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS file -->
     <link rel="stylesheet" href="../style.css" >
     <style>
        
.logo{
    width: 100px;
    height: 100px;
}
        .footer{
            position:absolute;
            bottom:0;
        }
        .edit_img{
            width: 100px;
            object-fit: contain;
        }
    </style>
</head>
<body>
      <!-- Bootstrap JS link -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- navbar -->
  <div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
       <a href="../index.php"><img src="../images/fast.png"  alt="" class="logo"/></a>
            <nav class="navbar navbar-expand-lg ">
                <ul class="navbar-nav">
                <?php
     if(isset($_SESSION['admin_username'])){
   echo "<li class='nav-item'>
   <a href='#' class='nav-link'>Welcome " .$_SESSION['admin_username']."</a>
 </li>";
 } else{
  echo "<li class='nav-item'>
  <a href='#' class='nav-link'>Welcome guest</a>
</li>";
 }  
 ?>
                </ul>
            </nav>
        </div>
    </nav>
    <!-- second child -->
    <div class="bg-light">
        <h3 class="text-center p-2">Manage details</h3>
    </div>
   
   
    <!-- third child -->
    <div class="row">
        <div class="col-md-12 bg-secondary p-1 text-center">
          <div class="button text-center ">
            <button><a href="index.php?insert_product" class="nav-link text-light bg-info my-1">Insert product</a></button>
            <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1">View Product</a></button>
            <button><a href="index.php?insert_categories" class="nav-link text-light bg-info my-1">Insert categories</a></button>
            <button><a href="index.php?view_categories" class="nav-link text-light bg-info my-1">View categories</a></button>
            <button><a href="index.php?insert_brands" class="nav-link text-light bg-info my-1">Insert brands</a></button>
            <button><a href="index.php?view_brands" class="nav-link text-light bg-info my-1">View brands</a></button>
            <button><a href="index.php?view_orders" class="nav-link text-light bg-info my-1">All orders</a></button>
            <button><a href="index.php?all_payments" class="nav-link text-light bg-info my-1">All payments</a></button>
            <button><a href="index.php?list_users" class="nav-link text-light bg-info my-1">List users</a></button>
            <button><?php
            if(isset($_SESSION['admin_username'])){
echo " 
<a href='./admin_logout.php' class='nav-link text-light bg-info my-1'>Logout</a>
</li>";
} else{
echo " 
<a href='./admin_login.php' class='nav-link  text-light bg-info my-1'>Login</a>
</li>";
}?>
  
               </button>
             
            </div>
            
        </div>
    </div>
    <!-- fourth child -->
    <div class="container my-3">
        <?php
         if(isset($_GET['insert_product'])){
            include("insert_product.php");
        }
        if(isset($_GET['insert_categories'])){
            include("insert_categories.php");
        }
        if(isset($_GET['insert_brands'])){
            include("insert_brands.php");
        }
        if(isset($_GET['view_products'])){
            include("view_products.php");
        }
        if(isset($_GET['edit_products'])){
            include("edit_products.php");
        }
        if(isset($_GET['delete_products'])){
            include("delete_products.php");
        }
        if(isset($_GET['view_categories'])){
            include("view_categories.php");
        }
        if(isset($_GET['view_brands'])){
            include("view_brands.php");
        }
        
        if(isset($_GET['edit_cat'])){
            include("edit_category.php");
        }

        if(isset($_GET['edit_brands'])){
            include("edit_brand.php");
        }
        if(isset($_GET['delete_brands'])){
            include("delete_brands.php");
        }
        if(isset($_GET['delete_cat'])){
            include("delete_category.php");
        }
        if(isset($_GET['view_orders'])){
            include("view_orders.php");
        }
        if(isset($_GET['delete_orders'])){
            include("delete_orders.php");
        }
        if(isset($_GET['all_payments'])){
            include("all_payments.php");
        }
        if(isset($_GET['delete_payment'])){
            include("delete_payment.php");
        }
        if(isset($_GET['list_users'])){
            include('list_users.php');
        }
        if(isset($_GET['delete_user'])){
            include('delete_user.php');
        }
        ?>
    </div>

    
 <!--last child-->
<?php include("../includes/footer.php"); ?>

  </div>

</body>
</html>