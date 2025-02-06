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
    <link rel="stylesheet" href="../assets/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
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
?>
<div class="container">
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-6 px-5" style="padding:135px">
            <form action="categories.php" method="post">
                <div class="form-group mb-4">
                    <input type="hidden" class="form-control" value="<?=$editdata['catid']?>" name="catid" style="background-color: #f2f2f2;">
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="catname" value="<?=$editdata['catname']?>" placeholder="Enter category" style="background-color: #f2f2f2;">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Update" name="update" style="background-color: #17a2b8; color: #fff;">
                </div>
            </form>
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
                                <a href="categories.php?update=true&editid=<?=$data['catid']?>" class="btn btn-primary"> Edit </a>
                                <a href="categories.php?deleteid=<?=$data['catid']?>" class="btn btn-danger"> Delete </a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else{
                    echo '<tr><td colspan="3">No category found</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php
} else {
?>
<div class="container">
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-6 px-5" style="padding:135px">
            <form action="movies.php" method="post" enctype="multipart/form-data">

                <div class="form-group mb-4">
                    <select name="catid" class="form-control" required>
                        <option value="">Select Category</option>

                        <?php
                        $sql = "SELECT * FROM `categories`";
                        $res = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($res) > 0) {
                            while ($data = mysqli_fetch_array($res)) {

                                ?> <option value="<?=$data['catid']?>"> <?=$data['catname']?>  </option> <?php
                            }
                        } 
                        ?> <option value="">No Category found</option> <?php
                        ?>
                    </select>
                </div>
                
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="description" placeholder="Enter Description" required>
                </div>
                <div class="form-group mb-4">
                    <input type="date" class="form-control" name="releasedate" required>
                </div>
                <div class="form-group mb-4">
                    Image:
                    <input type="file" class="form-control" name="image" accept="image/*" required>
                </div>
                <div class="form-group mb-4">
                    Trailer:
                    <input type="file" class="form-control" name="trailer" accept="video/*" required>
                </div>
                <div class="form-group mb-4">
                    Video:
                    <input type="file" class="form-control" name="movie" accept="video/*" required>
                </div>
                <div class="form-group mb-4">
                    <input type="number" class="form-control" name="rating" placeholder="Rating (Optional)">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Add Movie" name="add" style="background-color: #007bff; color: #fff;">
                </div>
            </form>
        </div>

        <!-- Right Column -->
        <div class="col-lg-6 px-5" style="padding:150px">
            <table class="table" style="background-color: yellow;">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Release Date</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>

                <?php
                $sql = "SELECT movies.*, categories.catname 
                FROM movies
                INNER JOIN categories on categories.catid = movies.catid";
                $res = mysqli_query($conn, $sql);

                if(mysqli_num_rows($res) > 0){
                    while($data = mysqli_fetch_array($res)){
                        ?>
                        <tr>
                            <td><?= $data['movieid']?></td>
                            <td><?= $data['title']?></td>
                            <td><?= $data['description']?></td>
                            <td><?= $data['releasedate']?></td>
                            <td><?= $data['rating']?></td>
                            <td>
                                <a href="movies.php?edit=<?=$data['movieid']?>" class="btn btn-primary"> Edit </a>
                                <a href="movies.php?deleteid=<?=$data['movieid']?>" class="btn btn-danger"> Delete </a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else{
                    echo '<tr><td colspan="6">No movies found</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php
}
?>

<?php
include('footer.php');
?>
</body>
</html>

<?php
if(isset($_POST['add'])){
    $catid = $_POST['catid'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $releasedate = $_POST['releasedate'];
    $rating = $_POST['rating'];

    // Handling file uploads
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];

    $trailer = $_FILES['trailer']['name'];
    $tmp_trailer = $_FILES['trailer']['tmp_name'];

    $movie = $_FILES['movie']['name'];
    $tmp_movie = $_FILES['movie']['tmp_name'];

    move_uploaded_file($tmp_image, "uploads/$image");
    move_uploaded_file($tmp_trailer, "uploads/$trailer");
    move_uploaded_file($tmp_movie, "uploads/$movie");

    $sql = "INSERT INTO `movies`(`title`, `description`, `releasedate`, `image`, `trailer`, `movie`, `rating`, `catid`) 
    VALUES ('$title', '$description', '$releasedate', '$image', '$trailer', '$movie', '$rating', '$catid')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Movie added successfully');</script>";
        echo "<script>window.location.href = 'movies.php';</script>";
    } else {
        echo "Movie is not added";
    }
}
?>
<?php

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