<?php

include("../includes/connection.php");
if (isset($_POST["insert_cat"])) {
  $category_title=$_POST["cat-title"];
  //select query
  $select_query="select * from `categories` where category_title='$category_title'";
  $result_select=mysqli_query($con,$select_query);
  $number=mysqli_num_rows($result_select);
  if ( $number>0) {
    echo "<script>alert('Category hase already been inserted')</script> ";
  }else{

  $insert_query="insert into `categories` (category_title) values ('$category_title') ";
  $result=mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('Category inserted successfuly')</script> ";
  }
}
}

?>
<h2 class="text-center">Insert categories</h2>

<form action="" method="post" class="mb-2">
     <div class="input-group w-90 mb-3">
      <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
      <input type="text" class="form-control" placeholder="Insert categories" name="cat-title" aria-label="Categories" aria-describedby="basic-addon1">
     </div>
     <div class="input-group w-10 mb-2 m-auto">
       
       <input type="submit" class="border-0 p-2 bg-info my-3" placeholder="Insert categories" name="insert_cat" 
      value="Insert categories"aria-label="Username" aria-describedby="basic-addon1">
       
    </div> 
</form>