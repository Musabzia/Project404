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
    <title>Movies</title>
    <link rel="stylesheet" href="../assets/css/style-starter.css">
	<link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap"
		rel="stylesheet">
    <style>
        body {
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }
    </style>
</head>
<body>

<?php
include ('header.php');
?>

<?php

error_reporting(0);

// Check if an update is requested
if (isset($_GET['update'])) {


    
    $catid = $_GET['update']; // Get the catid from the URL
    $sql = "SELECT * FROM categories WHERE catid = '$catid'"; // Fetch the specific category
    $res = mysqli_query($conn, $sql);
    $editdata = mysqli_fetch_array($res);
 

// print_r($editdata);

?>

<div class="row">
    <!-- Left Column -->
    <div class="col-lg-6 px-5" style="padding:135px">
        <form action="categories.php" method="post">

            <div class="form-group mb-4">
                <option value="">Select Category</option>
                <select name="" id="" class="catid">
                <?php
            $sql = "SELECT * FROM `categories`";
            $res = mysqli_query($conn, $sql);

            if(mysqli_num_rows($res) > 0){

                while($data = mysqli_fetch_array($res)){

                    ?> <option value="<?=$data['catid']?> <?=$data['catname']?>"></option> <?php

                }

            } ?> <option value="">No category found</option> <?php
            
            ?>
                </select>
            </div>


            <div class="form-group mb-4">
                <input type="hidden" class="form-control" name="title">
            </div>

            <div class="form-group mb-4">
                <input type="text" class="form-control" name="description">
            </div>

            <div class="form-group mb-4">
                <input type="date" class="form-control" name="releasedate">
            </div>

            <div class="form-group mb-4">
                <input type="file" class="form-control" name="image">
            </div>

            <div class="form-group mb-4">
                <input type="file" class="form-control" name="trailer">
            </div>

            <div class="form-group mb-4">
                <input type="file" class="form-control" name="movies">
            </div>

            <div class="form-group mb-4">
                <input type="text" class="form-control" name="rating">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Update" name="update" 
                style="background-color: #17a2b8; color: #fff;">
            </div>
        </form>
        </div>

        <?php 
        } else{
        ?>

        <div class="col-lg-6 px-5" style="padding:135px">

            <form action="categories.php" method="post">
                <div class="form-group mb-4">
                    
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="catname" value="" placeholder="Enter category" style="background-color: #f2f2f2;">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Add" name="add" style="background-color: #007bff; color: #fff;">
                    
                </div>
            </form>
            
        
        
        <?php
        }
        ?>
    </div>

    <!-- Right Column -->
    <div class="col-lg-6 px-5" style="padding:150px">
        <table class="table" style="background-color: yellow;">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM `categories`";
            $res = mysqli_query($conn, $sql);

            if(mysqli_num_rows($res) > 0){

                while($data = mysqli_fetch_array($res)){

                    ?>

                    <tr>
                        <td><?= $data['catid']?></td>
                        <td><?= $data['catname']?></td>
                        <td>
                            <a href="categories.php?update=<?=$data['catid']?>" class="btn btn-primary"> Edit </a>
                            <a href="categories.php?deleteid=<?=$data['catid']?>" class="btn btn-danger"> Delete </a>
                        </td>
                    </tr>

                    <?php
                }
            }
            else{
                echo 'No category found';
            }

            ?>
        </table>
    </div>


</div>

<?
include('footer.php');
?>

    
</body>
</html>

<?php

if(isset($_POST['add'])){
    global $conn;
    $catid = $_POST['catid'];
    $name = $_POST['catname'];
    $sql = "INSERT INTO `categories` (`catname`) VALUES ('$name')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Category added successfully');</script>";
        echo "<script>window.location.href = 'categories.php';</script>";
    } else {
        echo "Category is not added";
    }
    
}

if(isset($_POST['update'])){
    $catid = $_POST['catid'];
    $name = $_POST['catname'];

    $sql = "UPDATE `categories` SET `catname`='$name' WHERE `catid` = '$catid'"; 

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Category updated successfully');</script>";
        echo "<script>window.location.href = 'categories.php';</script>";
    } else {
        echo "<script>alert('Category not updated');</script>";
    }
}

if(isset($_GET['deleteid'])){
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM `categories` WHERE `catid` = '$deleteid'";
    $res = mysqli_query($conn, $sql);

    if($res){
        echo "<script>alert('Category deleted successfully');</script>";
        echo "<script>window.location.href = 'categories.php'</script>";
    } else {
        echo "<script>alert('Category not deleted');</script>";
    }
}
?>