 <h3 class="text-center text-success">All products</h3>
 <table class=" table table-bordered mt-5 text-center">
    <thead class="bg-info">
        <tr>
            <th>S/n</th>
            <th>Category title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

    </thead>
  <tbody class="bg-secondary text-light">
    <?php
    $select="select * from `categories` ";
    $result=mysqli_query($con,$select);
    $number=0;
 while($row=mysqli_fetch_assoc($result)){
    $cat_id=$row["category_id"];
    $cat_title=$row["category_title"];
    $number++;
     
 
    
    
    ?>
    <tr >
        <td><?php echo $number;?></td>
        <td><?php echo $cat_title;?></td>
        <td><a href='index.php?edit_cat=<?php echo $cat_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></a></td>
        <td><a href='index.php?delete_cat=<?php echo $cat_id ?>' class='text-light'><i class='fa-solid fa-trash'></a></td>
    </tr>
<?php
}
?>
 </tbody>
 </table>
