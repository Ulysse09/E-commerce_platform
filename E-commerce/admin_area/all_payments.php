<h3 class="text-center text-success">All payments</h3>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-info">
        <?php
     $get="select * from `user_payments`";
     $result=mysqli_query($con,$get);
     $row=mysqli_num_rows($result);
   
     

   if($row==0){
    echo "<h2 class='text-danger text-center mt-5'>No payments received yet</h2>";
   }  
     else{ 
      echo" <tr>
      <th>S/n</th>
      <th>Invoice number</th>
      <th>Amount</th>
      <th>Payment mode</th>
      <th>Order date</th>
      <th>Delete</th>
    </tr>
    <tbody class='bg-secondary text-light'>
    <tr>";}
 ?>
 <?php
        $number=0;
        while ($row_data=mysqli_fetch_assoc($result)) {
             $order_id=$row_data['order_id'];
             $payment_id=$row_data['payment_id'];
             $amount=$row_data['amount'];
             $payment_mode=$row_data['payment_mode'];
             $invoice_number=$row_data['invoice_number'];
             $payment_date=$row_data['date'];
             $number++;
        ?>     
             <td><?php echo $number;?></td>
             <td><?php echo $invoice_number?></td>
             <td><?php echo  $amount?></td>
             <td><?php echo $payment_mode?></td>
             <td><?php echo $payment_date;?></td>
             <td><a href='index.php?delete_payment=<?php echo $payment_id?>' class='text-light'><i class='fa-solid fa-trash'></a></td>
             </tr>
        
    <?php }

      

       ?>
     </tbody>

    </thead>
</table>