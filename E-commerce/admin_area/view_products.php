<?php

   include("../includes/connection.php");
   include("../functions/common_functions.php");
  
//    session_start();
     


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View products</title>
     <style>
    .v_p{
        overflow:hidden;
    }
    .table_img{
        height: 100px;
        width: 100px:
       
    }
    </style> 
    
</head>
<body>
    
    <h3 class="text-center text-success m-0 v_p">View product</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <th>S/N</th>
            <th>Product title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody class="bg-secondary text-light" >
          <?php
          $get_products="select * from `products`";
          $result= mysqli_query($con,$get_products);
          $number=0;
          while ($row=mysqli_fetch_assoc($result)) {
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];
            $status=$row['status'];
            $number++;
           ?> 
               <tr class='text-center'>
            <td><?php echo  $number?></td>
            <td><?php echo $product_title?></td>
            <td><img src='./product_images/<?php echo $product_image1?>' alt='' class='table_img'></td>
            <td><?php echo$product_price?>$</td>
            <td>
                <?php 
            $get_account="select * from `orders_pending` where product_id=$product_id";
            $result1=mysqli_query($con,$get_account);
            $row_count=mysqli_num_rows($result1);
            echo $row_count ?>
            </td>
            <td><?php echo $status?></td>
            <td><a href='index.php?edit_products=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></a></td>
            <td><a href='index.php?delete_products=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-trash'></a></td>
              </tr>
        
                     ;
     <?php     }
        ?>
        </tbody>
    </table>
</body>
</div>
</html>