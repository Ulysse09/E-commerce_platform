<?php

   include("./includes/connection.php");
   include("./functions/common_functions.php");
   session_start()
   


?>
  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <!--bootstrap link-->
    <!-- CSS bootstrap only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- font awesome-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- css link-->
<link rel="stylesheet" href="style.css">
  <style>
    .cart_images{
    width: 80px;
    height: 80px;
    object-fit: contain;
}
  </style>
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
        <li class="nav-item">
          <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php get_cart_item(); ?></sup></a>
        </li>
          
         
      </ul>
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


<!-- fourth child-table -->
 <div class="container">
    <div class="row">
    <form action="" method="post">
        <table class="table table-bordered text-center">
            <tbody>
              <!-- php code to display dynamic data -->
              <?php 
              global $con;
              $get_ip= getIPAddress();
              $total_price=0;
              $cart_query= "select * from `cart_details` where ip_address='$get_ip'"  ;
              $result_query=mysqli_query($con,$cart_query);
              $result_count=mysqli_num_rows($result_query);
              if($result_count>0){
               echo" <thead>
                <tr>
                    <th>Product title</th>
                    <th>Product image</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                    <th>Remove</th>
                    <th colspan=2 >Operations</th>
                </tr>
            </thead>";
            


             while  ($row=mysqli_fetch_array($result_query)) {
                 $product_id= $row['product_id'];
                 $select_products="select * from `products` where product_id = '$product_id' ";
                 $result_product=mysqli_query($con,$select_products);
                 while ($row_prod=mysqli_fetch_array($result_product)){
                     $product_price=array($row_prod['product_price']);
                     $price_table=$row_prod['product_price'];
                     $product_title=$row_prod['product_title'];
                     $product_image1=$row_prod['product_image1'];
                     $product_values=array_sum($product_price);
                     $total_price+=$product_values;
                 
               
                  ?>  
                                      
              
                <tr>
                    <td><?php echo $product_title?></td>
                    <td><img src="./admin_area/product_images/<?php echo $product_image1?>" class="cart_images" alt=""></td>
                    <td><input type="text"name="qty" class="form-input w-50"></td>
                    <?php 
                      $get_ip= getIPAddress();
                      if(isset($_POST["update_cart"])){
                        $quantity=$_POST['qty'];
                        $update_cart="update `cart_details` set quantity = $quantity where ip_address='$get_ip'";
                        $result_quantity=mysqli_query($con,$update_cart);
                        $total_price=$total_price*$quantity;


                      }
                    
                    
                     
                     ?>
                    <td><?php echo $price_table?>$</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>" id=""></td>
                    <td>
                         <!-- <button class="px-3 py-2 mx-3 bg-info border-0">Update</button> -->
                         <input type="submit" value="Update cart" class="px-3 py-2 mx-3 bg-info border-0" name="update_cart" method="post">
                         <!-- <button class="px-3 py-2 mx-3 bg-info border-0">Remove</button> -->
                         <input type="submit" value="Remove cart" class="px-3 py-2 mx-3 bg-info border-0" name="remove_cart" method="post">
                        
                     </td>

                </tr>
            <?php  }
                 
                }}
             else {
              echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
             }   
                
            ?>
            </tbody>
        </table>
        <!-- subtotal -->
        <div class="d-flex mb-3">
          <?php
        global $con;
              $get_ip= getIPAddress();
              $cart_query= "select * from `cart_details` where ip_address='$get_ip'"  ;
              $result_query=mysqli_query($con,$cart_query);
              $result_count=mysqli_num_rows($result_query);
              if($result_count>0){
                echo "<h4 class='px-3'>Subtotal:<strong class=text-info> $total_price  $</strong></h4>
                <input type='submit' value='Continue shopping' class='px-3 py-2 mx-3 bg-info border-0' name='continue_shopping' method='post'>
                <button class='px-3 py-2 bg-secondary border-0 text-light'><a href='users_area/checkout.php'class='text-light text-decoration-none'>Checkout</button></a> ";
              }
                else{
                 echo "<input type='submit' value='Continue shopping' class='px-3 py-2 mx-3 bg-info border-0' name='continue_shopping' method='post'>";
                }
                if(isset($_POST['continue_shopping'])){
                 echo "<script>window.open('index.php','_self')</script>";
                }
             ?>
            
        </div>
    </div>

 </div>
 </form>

<!-- function to delete cart -->
<?php
function remove_cart_item(){
  global $con;
  if(isset($_POST['remove_cart'])){
    foreach($_POST['removeitem'] as $remove_id){
      
      $delete_query="Delete from `cart_details` where product_id=$remove_id ";
      $run_delete=mysqli_query($con,$delete_query);
      if($run_delete){
        echo "<script>window.open('cart.php','_self') </script>";
      }
    }
  }
}
echo $remove_item= remove_cart_item();
?>


<!--last child-->
 <?php include("./includes/footer.php"); ?>
    <!-- bootstrap js link-->
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>