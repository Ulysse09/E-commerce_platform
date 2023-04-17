<?php

include("../includes/connection.php");
if (isset($_POST["insert_brand"])) {
  $brand_title=$_POST["brand-title"];
  //select query
  $select_query="select * from `brands` where brand_title='$brand_title'";
  $result_select=mysqli_query($con,$select_query);
  $number=mysqli_num_rows($result_select);
  if ( $number>0) {
    echo "<script>alert('Brand has already been inserted')</script> ";
  }else{

  $insert_query="insert into `brands` (brand_title) values ('$brand_title') ";
  $result=mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('Brand inserted successfuly')</script> ";
  }
}
}

?>

<h2 class="text-center">Insert brands</h2>

<form action="" method="post" class="mb-2">
     <div class="input-group w-90 mb-3">
      <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
      <input type="text" class="form-control" placeholder="Insert brands" name="brand-title" aria-label="Brands" aria-describedby="basic-addon1">
     </div>
     <div class="input-group w-10 mb-2 m-auto">
       
      <input type="submit" class="border-0 my-3 p-2 bg-info" placeholder="Insert brands" name="insert_brand" 
      value="Insert Brands"aria-label="Username" aria-describedby="basic-addon1">
      <!-- <button class="bg-info p-2 my-3 border-0">Insert Brands</button> -->
    </div> 
</form>
