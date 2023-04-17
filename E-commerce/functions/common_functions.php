<?php

//include('./includes/connection.php');

//sms api
function sms(){
    global $con;
    
        $data=array(
            "sender"=>'Intouch',
"recipients"=>"0784824525",//number of receiver
"message"=>"helloworld",//message to send to receiver
          );

$url="https://www.intouchsms.co.rw/api/sendsms/.json";
//intourch api
$data=http_build_query($data);
$username="Ulysse";//username of account
$password="NairobiFACE19"; //password of account
//initialize curl()
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_USERPWD,$username.":".$password);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$result=curl_exec($ch);
$httpcode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
curl_close($ch);
//closing curl()

//echo $result;//print response to screen but not necessary

// echo $httpcode;//print code but not necessary

    
}





// getting product
function getproducts(){
    global $con;
    if(!isset($_GET['cat'])){
        if(!isset($_GET['brand'])){
    

         $select_query= "Select * from `products` order by rand() limit 0,6";
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
         echo "<div class='col-md-4 mb-2 '>
         <div class='card ' >
         <img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>$product_description</p>
         <p class='card-text'>Price: $product_price$</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-info mx-1  '>Add to cart</a>
         <a href='product_details.php?product_id=$product_id' class='btn btn-secondary  '>View more</a>          
         </div>
         </div>
         </div>
          "   ;

          }
         }  
     }
}

// getting unique categories

function get_unique_cat(){
    global $con;
    if(isset($_GET['cat'])){
         $category_id=$_GET['cat'];
    

         $select_query= "Select * from `products` where category_id= $category_id";
         $result_query= mysqli_query($con,$select_query);
         $num_of_rows= mysqli_num_rows($result_query);
         if ($num_of_rows == 0 ){
            echo "<h2 class= 'text-danger'>No stock available for this category</h2>";
         }
 
         while ($row= mysqli_fetch_assoc($result_query) ) {
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_image=$row['product_image1'];
         $product_price=$row['product_price'];
         $category_id=$row['category_id'];
         $brand_id=$row['brand_id'];
         echo "<div class='col-md-4 mb-2 text-center'>
         <div class='card' >
         <img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>$product_description</p>
         <p class='card-text'>Price: $product_price/-</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-info  '>Add to cart</a>
          
         </div>
         </div>
         </div>
          "   ;

          
         }  
     }
    
}

// getting unique brands

function get_unique_brand(){
    global $con;
    if(isset($_GET['brand'])){
         $brand_id=$_GET['brand'];
    

         $select_query= "Select * from `products` where brand_id= $brand_id";
         $result_query= mysqli_query($con,$select_query);
         $num_of_rows= mysqli_num_rows($result_query);
         if ($num_of_rows == 0 ){
            echo "<h2 class= 'text-danger'>No stock available for this brand</h2>";
         }
 
         while ($row= mysqli_fetch_assoc($result_query) ) {
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_image=$row['product_image1'];
         $product_price=$row['product_price'];
         $category_id=$row['category_id'];
         $brand_id=$row['brand_id'];
         echo "<div class='col-md-4 mb-2 text-center'>
         <div class='card' >
         <img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>$product_description</p>
         <p class='card-text'>Price: $product_price/-</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-info  '>Add to cart</a>
         
         </div>
         </div>
         </div>
          "   ;

          
         }  
     }
    
}



// displaying brands in sidenav

function getbrands(){
    global $con;
    $select_brands="Select * from `brands`";
         $result_brands=mysqli_query($con,$select_brands);
         //$row_data=mysqli_fetch_assoc($result_brands);
        //echo $row_data["brand_title"];
        while ($row_data=mysqli_fetch_assoc($result_brands) ) {
          $brand_title=$row_data['brand_title'];
          $brand_id=$row_data['brand_id'];
          echo "<li class='nav-item '>
          <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
        </li>";
        }
}

// displaying categories

function getcat(){
    global $con;
    $select_cat="Select * from `categories`";
         $result_cat=mysqli_query($con,$select_cat);
         //$row_data=mysqli_fetch_assoc($result_brands);
        //echo $row_data["brand_title"];
        while ($row_data=mysqli_fetch_assoc($result_cat) ) {
          $cat_title=$row_data['category_title'];
          $cat_id=$row_data['category_id'];
          echo "<li class='nav-item '>
          <a href='index.php?cat=$cat_id' class='nav-link text-light'>$cat_title</a>
        </li>";
        }
}

function search_product(){

    global $con;
    if(isset($_GET['search_data_product'])){
        $search_data=$_GET['search_data'];

         
        $search_query="select * from `products` where product_keywords like '%$search_data%'";
         $result_query= mysqli_query($con,$search_query);
         $num_of_rows= mysqli_num_rows($result_query);
         if ($num_of_rows == 0 ){
            echo "<h2 class= 'text-danger'>No result found. Try again</h2>";
        }
         while ($row= mysqli_fetch_assoc($result_query) ) {
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_image=$row['product_image1'];
         $product_price=$row['product_price'];
         $category_id=$row['category_id'];
         $brand_id=$row['brand_id'];
         echo "<div class='col-md-4 mb-2'>
         <div class='card' >
         <img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>$product_description</p>
         <p class='card-text'>Price: $product_price/-</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
          
         </div>
         </div>
         </div>
          "   ;

          }
        }
         
        } 
// get all products
 function get_all_products(){
    global $con;
    if(!isset($_GET['cat'])){
        if(!isset($_GET['brand'])){
    

         $select_query= "Select * from `products` order by rand() ";
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
         echo "<div class='col-md-4 mb-2'>
         <div class='card' >
         <img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>$product_description</p>
         <p class='card-text'>Price: $product_price/-</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-info  '>Add to cart</a>
          
         </div>
         </div>
         </div>
          "   ;

          }
         }  
     }

 }
// get ip address function
 function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;

// cart function
function cart(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        
        $get_ip= getIPAddress();
        $get_product_id=$_GET['add_to_cart'];
        $select_query= "select * from `cart_details` where ip_address='$get_ip' and product_id= $get_product_id ";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows= mysqli_num_rows($result_query);
         if ($num_of_rows > 0 ){
            echo  "<script>alert('Item has already been added to cart')</script>";
            echo  "<script>window.open('index.php','_self')</script>";
         }
         else {
            $insert_query= "insert into `cart_details` (product_id,ip_address,quantity) values ($get_product_id,'$get_ip',0 )";
            $result_query=mysqli_query($con,$insert_query);
            echo  "<script>alert('Item added to cart')</script>";
            echo  "<script>window.open('index.php','_self')</script>";
         }
        
    }

}
// cart_item_numbers
function get_cart_item(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip= getIPAddress();
        $select_query= "select * from `cart_details` where ip_address='$get_ip'" ;
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items= mysqli_num_rows($result_query);
    }  
    else {
            global $con;
        $get_ip= getIPAddress();
        $select_query= "select * from `cart_details` where ip_address='$get_ip'"  ;
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items= mysqli_num_rows($result_query);
        
    }   
  echo $count_cart_items;

}
// total price function
function total_cart_price(){
    global $con;
     $get_ip= getIPAddress();
     $total_price=0;
     $cart_query= "select * from `cart_details` where ip_address='$get_ip'"  ;
     $result_query=mysqli_query($con,$cart_query);
    while  ($row=mysqli_fetch_array($result_query)) {
        $product_id= $row['product_id'];
        $select_products="select * from `products` where product_id = '$product_id' ";
        $result_product=mysqli_query($con,$select_products);
        while ($row_prod=mysqli_fetch_array($result_product)){
            $product_price=array($row_prod['product_price']);
            $product_values=array_sum($product_price);
            $total_price+=$product_values;
        }
        # code...
    }
  echo $total_price;       

}
// get user order details

function get_user_order_details(){
    global $con;
    $username=$_SESSION['username'];
    $get_details="select * from `user_table` where username='$username'";
    $result_query=mysqli_query($con,$get_details);
    while($row_query=mysqli_fetch_array($result_query)){
        $user_id=$row_query['user_id'];
        if(!isset($_GET['edit_account'])){
          if(!isset($_GET['my_orders'])){
            if(!isset($_GET['delete_account'])){
             $get_order="select * from `user_orders` where user_id=$user_id and order_status= 'pending'";
             $result_order=mysqli_query($con,$get_order);
             $row_count=mysqli_num_rows($result_order);
            if($row_count>0){
                  echo "<h3 class='text-center my-5'>You have <span class='text-danger'>$row_count </span>pending orders</h3>
                 <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order details</a></p>";
            }
              else{
              echo "<h3 class='text-center my-5'>You have <span class='text-success'>0 </span>pending orders</h3>
            <p class='text-center'><a href='../index.php' class='text-dark'>Explore products</a></p>";
            
         }
            }
          }
        }
    }

}

?>