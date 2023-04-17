<?php
 
 if(isset($_GET['edit_cat'])){
    $cat_id=$_GET['edit_cat'];
 
 }
$select="select *  from `categories`  where category_id =$cat_id";
$get=mysqli_query($con,$select);
$fetch=mysqli_fetch_assoc($get);
$cat_title=$fetch['category_title'];
 
if(isset($_POST['update_cat'])){
    $category_title=$_POST['cat_title'];
    $update_query="update `categories` set category_title = '$category_title' where category_id=$cat_id";
    $result=mysqli_query($con,$update_query);
    if($result){
        echo "<script>alert('Category successfully updated')</script>";
        echo "<script>window.open('index.php?view_categories','_self')</script>";

    }
}


?>


<div class="container text-center">
 <h1 class="text-center">Edit categories</h1>   
 <form action="" method="post">
      <div class="form-outline my-4 w-50 m-auto ">
        <label for="cat_title" class="form_label mb-2">Category title </label>
        <input type="text" class="form-control" name="cat_title" value=<?php echo"$cat_title"?> id="cat_title" required="required" >
        <input type="submit" value="Edit category" name="update_cat" class="btn btn-info  mt-3 px-3  ">
     </div>
    </form>
</div>