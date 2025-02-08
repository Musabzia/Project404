<?php
session_start();
include('../connect.php');

if(!isset($_SESSION['user_id'])){
    echo "<script>window.location.href = '../sign_in.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies and Categories Management</title>
    <link rel="stylesheet" href="../assets/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
    <style>
        body { overflow-x: hidden; padding-top: 100px;}
        .table-responsive { max-height: 400px; overflow-y: auto; }
    </style>
</head>
<body>
<?php include('header.php'); ?>

<?php
// Handle Category Update View
if (isset($_GET['update_category'])) {
    $catid = mysqli_real_escape_string($conn, $_GET['update_category']);
    $sql = "SELECT * FROM categories WHERE catid = '$catid'";
    $res = mysqli_query($conn, $sql);
    $editdata = mysqli_fetch_array($res);
?>
<div class="container">
    <div class="row" >
        <div class="col-lg-6 offset-lg-3 px-5 py-5">
            <form action="" method="post">
                <input type="hidden" name="catid" value="<?=$editdata['catid']?>">
                <div class="form-group mb-4">
                    <label>Category Name</label>
                    <input type="text" class="form-control" name="catname" value="<?=$editdata['catname']?>" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info" name="update_category_submit" value="Update Category">
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
} 
// Handle Movie Update View
elseif (isset($_GET['update_movie'])) {
    $movieid = mysqli_real_escape_string($conn, $_GET['update_movie']);
    $sql = "SELECT * FROM movies WHERE movieid = '$movieid'";
    $res = mysqli_query($conn, $sql);
    $movie_data = mysqli_fetch_array($res);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 px-5 py-5">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="movieid" value="<?=$movie_data['movieid']?>">
                <div class="form-group mb-4">
                    <label>Category</label>
                    <select name="catid" class="form-control" required>
                        <?php
                        $cat_sql = "SELECT * FROM categories";
                        $cat_res = mysqli_query($conn, $cat_sql);
                        while($cat = mysqli_fetch_array($cat_res)){
                            $selected = ($cat['catid'] == $movie_data['catid']) ? 'selected' : '';
                            echo "<option value='{$cat['catid']}' $selected>{$cat['catname']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="<?=$movie_data['title']?>" required>
                </div>
                <div class="form-group mb-4">
                    <label>Description</label>
                    <textarea class="form-control" name="description" required><?=$movie_data['description']?></textarea>
                </div>
                <div class="form-group mb-4">
                    <label>Release Date</label>
                    <input type="date" class="form-control" name="releasedate" value="<?=$movie_data['releasedate']?>" required>
                </div>
                <div class="form-group mb-4">
                    <label>Current Image</label>
                    <img src="uploads/<?=$movie_data['image']?>" style="max-width:200px;">
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>
                <div class="form-group mb-4">
                    <label>Current Trailer</label>
                    <video width="200" controls>
                        <source src="uploads/<?=$movie_data['trailer']?>" type="video/mp4">
                    </video>
                    <input type="file" class="form-control" name="trailer" accept="video/*">
                </div>
                <div class="form-group mb-4">
                    <label>Current Movie</label>
                    <video width="200" controls>
                        <source src="uploads/<?=$movie_data['movie']?>" type="video/mp4">
                    </video>
                    <input type="file" class="form-control" name="movie" accept="video/*">
                </div>
                <div class="form-group mb-4">
                    <label>Rating (Optional)</label>
                    <input type="number" class="form-control" name="rating" value="<?=$movie_data['rating']?>">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="update_movie_submit" value="Update Movie">
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
} 
// Default View for Adding Movies and Categories
else { 
?>
<div class="container" style="padding-top: 5rem;">
    <div class="row">
        <!-- Categories Section -->
        <div class="col-lg-6 px-5 py-5" style="padding-top: 10rem;">
            <h3>Add Category</h3>
            <form action="" method="post">
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="catname" placeholder="Enter Category Name" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="add_category" value="Add Category">
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM categories";
                        $res = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($res)){
                            ?>
                            <tr>
                                <td><?= $data['catid']?></td>
                                <td><?= $data['catname']?></td>
                                <td>
                                    <a href="?update_category=<?=$data['catid']?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="?delete_category=<?=$data['catid']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Movies Section -->
        <div class="col-lg-6 px-5 py-5">
            <h3>Add Movie</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <select name="catid" class="form-control" required>
                        <option value="">Select Category</option>
                        <?php
                        $sql = "SELECT * FROM categories";
                        $res = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($res)){
                            echo "<option value='{$data['catid']}'>{$data['catname']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
                </div>
                <div class="form-group mb-4">
                    <textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>
                </div>
                <div class="form-group mb-4">
                    <input type="date" class="form-control" name="releasedate" required>
                </div>
                <div class="form-group mb-4">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required>
                </div>
                <div class="form-group mb-4">
                    <label>Trailer</label>
                    <input type="file" class="form-control" name="trailer" accept="video/*" required>
                </div>
                <div class="form-group mb-4">
                    <label>Movie</label>
                    <input type="file" class="form-control" name="movie" accept="video/*" required>
                </div>
                <div class="form-group mb-4">
                    <input type="number" class="form-control" name="rating" placeholder="Rating (Optional)">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="add_movie" value="Add Movie">
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT movies.*, categories.catname 
                                FROM movies
                                INNER JOIN categories ON categories.catid = movies.catid";
                        $res = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($res)){
                            ?>
                            <tr>
                                <td><?= $data['movieid']?></td>
                                <td><?= $data['title']?></td>
                                <td><?= $data['catname']?></td>
                                <td>
                                    <a href="?update_movie=<?=$data['movieid']?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="?delete_movie=<?=$data['movieid']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include('footer.php'); ?>
</body>
</html>

<?php
// Process Add Category
if(isset($_POST['add_category'])){
    $catname = mysqli_real_escape_string($conn, $_POST['catname']);
    
    $sql = "INSERT INTO categories (catname) VALUES ('$catname')";
    
    if(mysqli_query($conn, $sql)){
        echo "<script>
            alert('Category added successfully');
            window.location.href = '';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error adding category: " . mysqli_error($conn) . "');
            window.location.href = '';
        </script>";
        exit();
    }
}

// Process Update Category
if(isset($_POST['update_category_submit'])){
    $catid = mysqli_real_escape_string($conn, $_POST['catid']);
    $catname = mysqli_real_escape_string($conn, $_POST['catname']);
    
    $sql = "UPDATE categories SET catname='$catname' WHERE catid = '$catid'"; 

    if(mysqli_query($conn, $sql)){
        echo "<script>
            alert('Category updated successfully');
            window.location.href = '';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error updating category: " . mysqli_error($conn) . "');
            window.location.href = '';
        </script>";
        exit();
    }
}

// Process Add Movie
if(isset($_POST['add_movie'])){
    $catid = mysqli_real_escape_string($conn, $_POST['catid']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $releasedate = mysqli_real_escape_string($conn, $_POST['releasedate']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating'] ?? '');

    // File uploads
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $image_path = "uploads/" . uniqid() . "_" . $image;
    move_uploaded_file($tmp_image, $image_path);

    $trailer = $_FILES['trailer']['name'];
    $tmp_trailer = $_FILES['trailer']['tmp_name'];
    $trailer_path = "uploads/" . uniqid() . "_" . $trailer;
    move_uploaded_file($tmp_trailer, $trailer_path);

    $movie = $_FILES['movie']['name'];
    $tmp_movie = $_FILES['movie']['tmp_name'];
    $movie_path = "uploads/" . uniqid() . "_" . $movie;
    move_uploaded_file($tmp_movie, $movie_path);

    $sql = "INSERT INTO movies(title, description, releasedate, image, trailer, movie, rating, catid) 
            VALUES ('$title', '$description', '$releasedate', '$image_path', '$trailer_path', '$movie_path', '$rating', '$catid')";

    if(mysqli_query($conn, $sql)){
        echo "<script>
            alert('Movie added successfully');
            window.location.href = '';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error adding movie: " . mysqli_error($conn) . "');
            window.location.href = '';
        </script>";
        exit();
    }
}

// Process Update Movie
if(isset($_POST['update_movie_submit'])){
    $movieid = mysqli_real_escape_string($conn, $_POST['movieid']);
    $catid = mysqli_real_escape_string($conn, $_POST['catid']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $releasedate = mysqli_real_escape_string($conn, $_POST['releasedate']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating'] ?? '');

    // Fetch existing movie data
    $fetch_sql = "SELECT * FROM movies WHERE movieid = '$movieid'";
    $fetch_result = mysqli_query($conn, $fetch_sql);
    $existing_movie = mysqli_fetch_array($fetch_result);

    // Prepare the SQL update statement
    $sql = "UPDATE movies SET catid='$catid', title='$title', description='$description', releasedate='$releasedate', rating='$rating'";

    // Check if new files are uploaded and update paths
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . uniqid() . "_" . $image;
        move_uploaded_file($tmp_image, $image_path);
        $sql .= ", image='$image_path'";
    } else {
        $sql .= ", image='" . $existing_movie['image'] . "'";
    }

    if (!empty($_FILES['trailer']['name'])) {
        $trailer = $_FILES['trailer']['name'];
        $tmp_trailer = $_FILES['trailer']['tmp_name'];
        $trailer_path = "uploads/" . uniqid() . "_" . $trailer;
        move_uploaded_file($tmp_trailer, $trailer_path);
        $sql .= ", trailer='$trailer_path'";
    } else {
        $sql .= ", trailer='" . $existing_movie['trailer'] . "'";
    }

    if (!empty($_FILES['movie']['name'])) {
        $movie = $_FILES['movie']['name'];
        $tmp_movie = $_FILES['movie']['tmp_name'];
        $movie_path = "uploads/" . uniqid() . "_" . $movie;
        move_uploaded_file($tmp_movie, $movie_path);
        $sql .= ", movie='$movie_path'";
    } else {
        $sql .= ", movie='" . $existing_movie['movie'] . "'";
    }

    $sql .= " WHERE movieid = '$movieid'";

    if(mysqli_query($conn, $sql)){
        echo "<script>
            alert('Movie updated successfully');
            window.location.href = '';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error updating movie: " . mysqli_error($conn) . "');
            window.location.href = '';
        </script>";
        exit();
    }
}