<?php
include("../includes/connection.php");
if(isset($_POST['insert_product']))
{
  $product_title=$_POST['product_title'];
  $product_description=$_POST['description'];
  $product_keyword=$_POST['keywords'];
  $product_category=$_POST['product_category'];
  $product_brand=$_POST['product_brand'];
  $product_status= 'true';
  
  // accessing images
  $product_image=$_FILES['product_image1']['name'];
  // accessung tmp images
  $tmp_image=$_FILES['product_image1']['tmp_name']; 
  
  
  $product_price=$_POST['price'];
   
  // checking empty condition
  if($product_title==''or $product_description==''or $product_keyword=='' or $product_category=='' or $product_brand=='' or $product_image=='' or $product_price==''
  ){
    echo "<script>alert('Please fill all fields')</script>";
    exit();
    } 
    else{
      move_uploaded_file($tmp_image,"./product_images/$product_image");
      // insert query
        $insert_products="insert into `products` (product_title,product_description,product_keywords,category_id,brand_id,product_image1,product_price,date,status) values ('$product_title','$product_description','$product_keyword','$product_category','$product_brand','$product_image','$product_price',NOW(),'$product_status')";

      $result_query=mysqli_query($con,$insert_products);
      if ($result_query) {
        echo "<script>alert('Successfully inserted products')</script>";
        echo "<script>window.open('./index.php','_self')</script> ";
      }
      


    }
  
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert products-Admin dashboard</title>
    <!--bootstrap link-->
    <!-- CSS bootstrap only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- font awesome-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- css link-->
<link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert product</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product title</label>
            <input type="text" name="product_title" id="product_title" class="form-control" autocomplete='off' placeholder="Enter product name" required>
          </div>
        
        <!-- description -->
          <div class="form-outline mb-4 w-50 m-auto">
            <label for="description" class="form-label">Product description</label>
            <input type="text" name="description" id="description" class="form-control" autocomplete='off' placeholder="Enter description name" required>
          </div>

          <!-- keywords -->
          <div class="form-outline mb-4 w-50 m-auto">
            <label for="keywords" class="form-label">Product Keyword </label>
            <input type="text" name="keywords" id="keywords" class="form-control" autocomplete='off' placeholder="Enter Product Keywords " required>
          </div>

          <!-- categories -->
          <div class="form-outline mb-4 w-50 m-auto">
           <select name="product_category" id="" class="form-select">
           <option value="">Select category</option>
            <?php
            $select_query = "select * from `categories`";
            $result_query = mysqli_query($con,$select_query);
            while($row=mysqli_fetch_assoc($result_query)){
                $cat_title=$row['category_title'];
                $cat_id=$row['category_id'];
                echo "<option value='$cat_id'>$cat_title</option>";

            }
            ?> 
            <!--<option value="">cat1</option>
            <option value="">c2 </option>
            <option value="">c3 </option> -->
           </select> 
          </div>

           <!-- brands -->
          <div class="form-outline mb-4 w-50 m-auto">
           <select name="product_brand" id="" class="form-select">
            <option value="">Select brand</option>
            <?php
            $select_query = "select * from `brands`";
            $result_query = mysqli_query($con,$select_query);
            while($row=mysqli_fetch_assoc($result_query)){
                $brand_title=$row['brand_title'];
                $brand_id=$row['brand_id'];
                echo "<option value='$brand_id'>$brand_title</option>";

            }
            ?> 
            



           <!-- <option value="">b1</option>
            <option value="">b2 </option>
            <option value="">b3 </option>-->
           </select>
          </div>--

          <!-- Image 1 -->
          <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image1" class="form-label">Product Image </label>
            <input type="file" name="product_image1" id="product_image1" class="form-control"   required>
          </div>

          <!-- price -->
          <div class="form-outline mb-4 w-50 m-auto">
            <label for="price" class="form-label">Product price </label>
            <input type="text" name="price" id="price" class="form-control" autocomplete='off' placeholder="Enter Product price " required>
          </div>

          <!-- submit -->
          <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" id="insert_product" class="btn btn-info mb-3 px-3" value="Insert products"  required>
          </div>



            
        </form>
    </div>
</body>
</html>
 