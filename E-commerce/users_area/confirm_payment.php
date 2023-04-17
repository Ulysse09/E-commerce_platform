
<?php

   include("../includes/connection.php");
   include("../functions/common_functions.php");
      
   session_start();
    if(isset($_GET['order_id'])){
        $order_id=$_GET['order_id'];
        $user_id=$_GET['user_id'];
       // echo $order_id;
       $select_data="Select * from `user_orders` where order_id=$order_id";
       $get_data=mysqli_query($con,$select_data);
       $row_data=mysqli_fetch_assoc($get_data);
       $invoice_number=$row_data['invoice_number'];
       $amount_due=$row_data['amount_due'];

       $select_data1="Select * from `user_table` where user_id=$user_id";
       $get_data1=mysqli_query($con,$select_data1);
       $row_data1=mysqli_fetch_assoc($get_data1);
       $user_name=$row_data1['username'];
       $user_number=$row_data1['user_mobile'];
       $amount_due=$row_data['amount_due'];

 
    } 

  if(isset($_POST['confirm_payment'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];

    $user_number=$_POST['u_number'];
    $insert_query= "insert into `user_payments` (order_id,invoice_number,amount,payment_mode) values ($order_id,$invoice_number,$amount,'$payment_mode')";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<script>alert('Succesfully confirmed payment')</script>";
       // echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
       $update_orders= "update `user_orders` set order_status= 'Complete' where order_id= $order_id";
       $result_query=mysqli_query($con,$update_orders);
//sms();

    global $con;
    
        $data=array(
            "sender"=>'+250784824525',
"recipients"=>"$user_number",//number of receiver
"message"=>"Hello $user_name your order has been confirmed,You  have paid: $amount",//message to send to receiver
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

    echo "<script>window.open('profile.php?my_orders','_self')</script>";  
}

  
   
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

 </head>
 <body class='bg-secondary'>
    <h1 class="text-light text-center">Confirm payment</h1>
    <div class="container my-5 ">
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount:</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
            <select name="payment_mode" class="form-select w-50 m-auto" >
            <option>Select payment mode</option>
            <option>MTN mobile money</option>
            <option>Tigo cash</option>
            <option>Offline</option>
            </select>    
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Enter your number:</label>
                <input type="text" class="form-control w-50 m-auto" name="u_number" value="<?php echo $user_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
              <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment" >
            </div>
        </form>
    </div>
    
 </body>
 </html>



