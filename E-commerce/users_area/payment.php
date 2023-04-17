<?php
include('../includes/connection.php');
include('../functions/common_functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
    
    <!--bootstrap link-->
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- font awesome-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .payment_img{
            width: 50%;
            margin:auto;
            display:block;
        }
    </style>

<script src="https://www.paypal.com/sdk/js?client-id=AbFh6fDyT8lcOUtX5zZU4hL-vx4x9A9AwZviDdLm3Th4ZTjapUbzxvL89C-Fdpfpc7iptOnIinrhYQuw&currency=USD"></script>



</head>
<body>
   


 <!-- php code to order using user id -->
    <?php
  $user_ip= getIPAddress();
  $get_users="select * from `user_table` where user_ip='$user_ip'";
  $result=mysqli_query($con,$get_users);
  while($run_query=mysqli_fetch_array($result)){
    $user_id=$run_query['user_id'];
  }
  $total_price=total_cart_price();

    ?>
    <div class='container'>
      <h2 class="text-center text-info">Payment info</h2>
      <div class="row d-flex justify-content-center align-items-center my-5">
        <div class="col-md-6">
        <div id="paypal-button-container"></div>
      <!-- <a href="https://www.paypal.com" target="_blank"><img src="../images/upi.png" class="payment_img" alt=""></a>
--></div> 
        <div class="col-md-6">
        <a href="order.php?user_id=<?php echo $user_id?>" ><h2 class='text-center'>Pay offline</h2></a>
        </div>
        
      </div>
      <script>
    paypal.Buttons({
      // Sets up the transaction when a payment button is clicked
      createOrder: (data, actions) => {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '<?= $total_price?>' // Can also reference a variable or function
            }
          }]
        });
      },
      // Finalize the transaction after payer approval
      onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
          // Successful capture! For dev/demo purposes:
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
          const transaction = orderData.purchase_units[0].payments.captures[0];
          alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
          // When ready to go live, remove the alert and show a success message within this page. For example:
          // const element = document.getElementById('paypal-button-container');
          // element.innerHTML = '<h3>Thank you for your payment!</h3>';
          // Or go to another URL:  actions.redirect('thank_you.html');
        });
      }
    }).render('#paypal-button-container');
  </script>
  
</body>
</html>