<?php 
include('../connect.php');  

if(!isset($_SESSION['user_id'])){
    echo "<script>window.location.href = '../sign_in.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <!-- <?php include('header.php');?> -->
    echo "<h1 style='color: white;'> Welcome to Admin Dashboard</h1>";
    
    <?php include('footer.php'); ?>
    
</body>
</html>