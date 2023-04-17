<h3 class="text-center text-success">All orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
     $get="select * from `user_orders`";
     $result=mysqli_query($con,$get);
     $row=mysqli_num_rows($result);
   
     

   if($row==0){
    echo "<h2 class='text-danger text-center mt-5'>No orders found</h2>";
   }  
     else{ 
      echo" <tr>
      <th>S/n</th>
      <th>Due amount</th>
      <th>Invoice number</th>
      <th>Total product</th>
      <th>Order date</th>
      <th>Status</th>
      <th>Delete</th>
    </tr>
    <tbody class='bg-secondary text-light'>
    <tr>";}
 ?>
 <?php
        $number=0;
        while ($row_data=mysqli_fetch_assoc($result)) {
             $order_id=$row_data['order_id'];
             $amount_due=$row_data['amount_due'];
             $user_id=$row_data['user_id'];
             $invoice_number=$row_data['invoice_number'];
             $total_products=$row_data['total_products'];
             $order_date=$row_data['order_date'];
             $order_status=$row_data['order_status'];
             $number++;
        ?>     
             <td><?php echo $number;?></td>
             <td><?php echo $amount_due;?></td>
             <td><?php echo $invoice_number;?></td>
             <td><?php echo $total_products;?></td>
             <td><?php echo $order_date;?></td>
             <td><?php echo $order_status;?></td>
             <td><a href='index.php?delete_orders=<?php echo $order_id?>' class='text-light'><i class='fa-solid fa-trash'></a></td>
             </tr>
        
    <?php }

      

       ?>
     </tbody>

    </thead>
</table>