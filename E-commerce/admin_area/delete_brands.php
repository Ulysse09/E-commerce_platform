<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <h2 class="text-center text-danger mb-4 ">Delete brands</h2>
    <form action="" method="post">
        <div class="form-outline mb-4">
            <input type="submit" value="Delete brands" name="delete_brands" class="form-control w-50 m-auto">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" value="Don't delete brands" name="dont_delete" class="form-control w-50 m-auto">
        </div>
    </form>
    <?php
    //$user_session=$_SESSION['username'];
    if(isset($_GET['delete_brands'])){
        $delete_id=$_GET['delete_brands'];
        $delete_query="Delete  from `brands` where brand_id= '$delete_id'";
        $result=mysqli_query($con,$delete_query);
      if($result){
        

        session_destroy();
        echo "<script>alert('Product deleted succesfully')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
      }
    
    
    }
    elseif(isset($_POST['dont_delete'])){
        echo "<script>window.open('./index.php','_self')</script>";
    }
    
    ?>
 
</body>
</html>