<h3 class="text-center text-success">All brands</h3>
 <table class=" table table-bordered mt-5 text-center">
    <thead class="bg-info">
        <tr>
            <th>S/n</th>
            <th>Brand title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

    </thead>
  <tbody class="bg-secondary text-light">
    <?php
    $select="select * from `brands` ";
    $result=mysqli_query($con,$select);
    $number=0;
 while($row=mysqli_fetch_assoc($result)){
    $brand_id=$row["brand_id"];
    $brand_title=$row["brand_title"];
    $number++;
     
 
    
    
    ?>
    <tr >
        <td><?php echo $number;?></td>
        <td><?php echo $brand_title;?></td>
        <td><a href='index.php?edit_brands=<?php echo $brand_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></a></td>
        <td><a href='index.php?delete_brands=<?php echo $brand_id ?>' class='text-light'><i class='fa-solid fa-trash'></a></td>
    </tr>
<?php
}
?>
 </tbody>
 </table>
