<?php
include('../includes/connection.php');
include('../functions/common_functions.php');
//echo 'hello';

if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];

}

// getting total cart items and cart price 
$get_ip=getIPAddress();
$total_price=0;
$cart_query="select * from `cart_details` where ip_address='$get_ip'";
$result_query=mysqli_query($con,$cart_query);
$invoice_number=mt_rand();
$status='Pending';
$count_cart=mysqli_num_rows($result_query);
while($row_cart=mysqli_fetch_array($result_query)){
    $product_id=$row_cart['product_id'];
    $select_product="select * from `products` where product_id='$product_id'";
    $result_product=mysqli_query($con,$select_product);

    while($row_product_price=mysqli_fetch_array($result_product)){
      $product_price=array($row_product_price['product_price']);
      $product_price_sum=array_sum($product_price);
      $total_price+=$product_price_sum;
  
  }
}




//<!-- getting quantity from cart -->
$get_cart = "select * from `cart_details`";
$run_cart=mysqli_query($con,$get_cart);
$get_quantity=mysqli_fetch_array($run_cart);
$quantity=$get_quantity['quantity'];
if($quantity==0){
    $quantity=1;
    $sub_total=$total_price;
}
 else{
    $quantity=$quantity;
    $sub_total=$total_price*$quantity;
 }

//  query to insert orders into database
$insert_order= "insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) values ($user_id,$sub_total,$invoice_number,$count_cart,NOW(),'$status')";
$result_q=mysqli_query($con,$insert_order);
if($result_q){
    echo "<script>alert('Orders submitted successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

// orders pending

$insert_pending_order= "insert into `orders_pending` (user_id,invoice_number,product_id,quantity,order_status) values ($user_id,$invoice_number,$product_id,$quantity,'$status')";
$result_pending_order=mysqli_query($con,$insert_pending_order);

//delete from cart 
$empty_cart="delete from `cart_details` where ip_address='$get_ip'";
$result_delete=mysqli_query($con,$empty_cart);

?>