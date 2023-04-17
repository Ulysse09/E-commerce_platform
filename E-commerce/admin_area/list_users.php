 

<h3 class="text-center text-success">All users</h3>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-info">
        <?php
     $get="select * from `user_table`";
     $result=mysqli_query($con,$get);
     $row=mysqli_num_rows($result);
   
     

   if($row==0){
    echo "<h2 class='text-danger text-center mt-5'>No user accounts found</h2>";
   }  
     else{ 
      echo" <tr>
      <th>S/n</th>
      <th>User name</th>
      <th>User e-mail</th>
      <th>User image</th>
      <th>User address</th>
      <th>User mobile</th>
      <th>Delete</th>
    </tr>
    <tbody class='bg-secondary text-light'>
    <tr>";}
 ?>
 <?php
        $number=0;
        while ($row_data=mysqli_fetch_assoc($result)) {
             $user_id=$row_data['user_id'];
             $username=$row_data['username'];
             $user_email=$row_data['user_email'];
             $user_image=$row_data['user_image'];
             $user_address=$row_data['user_address'];
             $user_mobile=$row_data['user_mobile'];
             $number++;
        ?>     
             <td><?php echo $number;?></td>
             <td><?php echo  $username?></td>
             <td><?php echo  $user_email?></td>
             <td><?php echo "<img src='../users_area/user_images/$user_image' class='edit_img' alt=''>" ?></td>
             <td><?php echo $user_address;?></td>
             <td><?php echo $user_mobile;?></td>
             <td><a href='index.php?delete_user=<?php echo $user_id?>' class='text-light'><i class='fa-solid fa-trash'></a></td>
             </tr>
        
    <?php }

      

       ?>
     </tbody>

    </thead>
</table>