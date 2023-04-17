 <?php

session_start();
session_unset();
session_destroy();
echo "<script>alert('You have logged out')</script>";
echo "<script>window.open('../index.php','_self')</script>";


?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>logout</h2>
</body>
</html>