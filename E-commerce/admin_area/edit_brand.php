<?php
 
 if(isset($_GET['edit_brands'])){
    $brand_id=$_GET['edit_brands'];
 }

$select="select *  from `brands`  where brand_id =$brand_id";
$get=mysqli_query($con,$select);
$fetch=mysqli_fetch_assoc($get);
$brand_title=$fetch['brand_title'];

if(isset($_POST['update_brand'])){
    $brands_title=$_POST['brand_title'];
    $update_query="update `brands` set brand_title = '$brands_title' where brand_id=$brand_id";
    $result=mysqli_query($con,$update_query);
    if($result){
        echo "<script>alert('Brands successfully updated')</script>";
        echo "<script>window.open('index.php?view_brands','_self')</script>";

    }
}


?>


<div class="container text-center">
 <h1 class="text-center">Edit brands</h1>   
 <form action="" method="post">
      <div class="form-outline my-4 w-50 m-auto ">
        <label for="cat_title" class="form_label mb-2">Brand title </label>
        <input type="text" class="form-control" value=<?php echo"$brand_title"?> name="brand_title" id="brand_title" required="required" >
        <input type="submit" value="Edit brand" name="update_brand" class="btn btn-info  mt-3 px-3  ">
     </div>
    </form>
</div>

