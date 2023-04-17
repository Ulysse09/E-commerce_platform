<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="text-center">
        <?php
      $username=$_SESSION['username'];
      $get_user="select * from `user_table` where username='$username'";
      $result=mysqli_query($con,$get_user);
      $row_fetch=mysqli_fetch_assoc($result);
      $user_id=$row_fetch['user_id'];
      //echo $user_id;
        ?>
        <h3 class="text-success">All my orders</h3>
        <table class="table table-bordered mt-5">
            <thead class="bg-info">
            <tr>
                <th>SI no</th>
                <th>Amount due</th>
                <th>Total products</th>
                <th>Invoice number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody class="bg-secondary text-light">
                <?php
                $get_order_details= "Select * from `user_orders` where user_id=$user_id";
                $result_order=mysqli_query($con,$get_order_details);
                $number=1;
               while($row=mysqli_fetch_assoc($result_order)){
                 $order_id=$row['order_id'];
                 $amount_due=$row['amount_due'];
                 $total_products=$row['total_products'];
                 $order_date=$row['order_date'];
                 $order_status=$row['order_status'];
                 if($order_status !='Pending'){
                    $order_status="Complete";
                 }else{
                    $order_status="Incomplete";
                 }
                 
                 $invoice_number=$row['invoice_number'];
                 
                  echo "   <tr>
                  <td>$number</td>
                  <td> $amount_due</td>
                  <td>$total_products</td>
                  <td>$invoice_number</td>
                  <td>$order_date</td>
                  <td>$order_status</td>";
                  
                  ?>
                  <?php
                  if($order_status=='Complete'){
                    echo "<td>Paid</td>";
                  }else{
                 echo "<td><a href='confirm_payment.php?order_id=$order_id&&user_id=$user_id' class='text-light'>Confirm</a></td>
               </tr>
               "
               ; }
               $number++ ;
               }
               ?>
                
                
            
              
            </tbody>
        </table>
    </div>
</body>
</html>