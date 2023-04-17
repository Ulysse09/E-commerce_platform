<?php
if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    $select="select * from `products` where product_id=$edit_id";
    $result=mysqli_query($con,$select);
    $row=mysqli_fetch_assoc($result);
     
   $product_id=$row['product_id'];
   $product_title=$row['product_title'];
   $product_description=$row['product_description'];
   $product_keywords=$row['product_keywords'];
   $category_id=$row['category_id'];
   $brand_id=$row['brand_id'];
   $product_image1=$row['product_image1'];
   $product_price=$row['product_price'];
}

// fetching category 

$select_cat= "select * from `categories` where category_id=$category_id ";
$result_cat=mysqli_query($con,$select_cat);
$fetch_cat=mysqli_fetch_assoc($result_cat);
$category_title=$fetch_cat['category_title'];
//echo $category_title;

// fetching brand 

$select_brand= "select * from `brands` where brand_id=$brand_id ";
$result_brand=mysqli_query($con,$select_brand);
$fetch_brand=mysqli_fetch_assoc($result_brand);
$brand_title=$fetch_brand['brand_title'];
//echo "$brand_title";



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .edit_img{
            width: 100px;
            height:100px;
            
        }
    </style>
</head>
<body>
     <div class="container">
        <h2 class= "text-center mt-4">Edit products</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto mb-4">
             <label for="product_title " class="form-label"  >Product title</label>
             <input type="text" name="product_title" value="<?php echo $product_title?>" id="product_title" class="form-control" required="required" > 
            </div>
            <div class="form-outline w-50 m-auto mb-4">
             <label for="product_desc " class="form-label" >Product description</label>
             <input type="text" name="product_desc" value="<?php echo $product_description?>" id="product_desc" class="form-control" required="required"   > 
            </div>
            <div class="form-outline w-50 m-auto mb-4">
             <label for="product_keywords " class="form-label" >Product Keyword</label>
             <input type="text" name="product_keywords" value=<?php echo "$product_keywords"?> id="product_keywords" class="form-control" required="required"  > 
            </div>
            <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category " class="form-label" >Product category</label> 
                <select name="product_category" class="form-select" required="required">
                       <option value="<?php echo $category_title?>"><?php echo $category_title?></option>;                         
                       <?php
             
             $select_cat_all= "select * from `categories`  ";
             $result_cat_all=mysqli_query($con,$select_cat_all);
             while($fetch_cat_all=mysqli_fetch_assoc($result_cat_all)){
             $category_title_all=$fetch_cat_all['category_title'];
             $category_id_all=$fetch_cat_all['category_id'];
             echo "<option value='$category_id_all'>$category_title_all</option>"   ; 
         }
             ?>  
<!-- 
                   <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option> -->
                </select> 
            </div>
            <div class="form-outline w-50 m-auto mb-4">
             <label for="product_brand " class="form-label" >Product brand</label> 
                <select name="product_brand" class="form-select" required="required">
                    <option  value="<?php echo $brand_title?>"><?php echo $brand_title?></option>;                         
                    <?php
             
            $select_brand_all= "select * from `brands`  ";
            $result_brand_all=mysqli_query($con,$select_brand_all);
            while($fetch_brand_all=mysqli_fetch_assoc($result_brand_all)){
            $brand_title_all=$fetch_brand_all['brand_title'];
            $brand_id_all=$fetch_brand_all['brand_id'];
            echo "<option value='$brand_id_all'>$brand_title_all</option>"   ; 
        }
            ?> 
           
                    
                    <!-- <option>3</option>
                    <option>4</option>
                    <option>5</option> -->
                </select> 
            </div>
            <div class="form-outline w-50 m-auto mb-4">
             <label for="product_image1 " class="form-label" >Product Image</label>
             <div class="d-flex">
             <input type="file" name="product_image1" id="product_image1" class="form-control w-90 m-auto"> 
              <img src="./product_images/<?php echo $product_image1?>" alt="" class="edit_img">
             </div>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
             <label for="product_price " class="form-label" >Product price</label>
             <input type="text" name="product_price" id="product_price" class="form-control"  value="<?php echo $product_price?>" required="required" > 
            </div>
            <!-- update button -->
            <div class="form-outline w-50 m-auto mb-4 text-center">
             <input type="submit" value="Update product" name="update_product" id="update_product" class="btn btn-info mb-3 px-3" > 
            </div>



        </form>
     
  
        <!-- Updating/editing products -->
      <?php
      
      if(isset($_POST["update_product"])){
  
        $product_title=$_POST['product_title'];
        $product_desc=$_POST['product_desc'];
        $product_keywords=$_POST['product_keywords'];
        $product_category=$_POST['product_category'];
        $product_brand=$_POST['product_brand'];
        
        $product_price=$_POST['product_price'];
        
        
        $product_image1=$_FILES['product_image1']['name'];
        $tmp_product_image1=$_FILES['product_image1']['tmp_name'];
      

        move_uploaded_file( $tmp_product_image1,"./product_images/$product_image1");
      
      
        // update query 
      $update_product="update `products` set product_title='$product_title',product_description=' $product_desc',product_keywords='$product_keywords', category_id='$product_category',brand_id='$product_brand',product_image1='$product_image1',product_price=$product_price,date=NOW() where product_id=$edit_id";
      $result_update=mysqli_query($con,$update_product);
      if($result_update){
        echo "<script>alert('Update successful')</script> ";
        //echo "<script>window.open('./insert_product.php','_self')</script> ";
      }
      
      }
      
      
      
      ?>

     </div>
</body>
</html>