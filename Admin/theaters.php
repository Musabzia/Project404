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
    <title>Theater Management</title>
    <link rel="stylesheet" href="../assets/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
    <style>
        body { overflow-x: hidden; padding-top: 100px; }
        .table-responsive { max-height: 400px; overflow-y: auto; }
    </style>
</head>
<body>
<?php include('header.php'); ?>

<?php
// Handle Theater Update View
if (isset($_GET['editid'])) {
    $theaterid = mysqli_real_escape_string($conn, $_GET['editid']);
    $sql = "SELECT * FROM theater WHERE theaterid = '$theaterid'";
    $res = mysqli_query($conn, $sql);
    $theater_data = mysqli_fetch_array($res);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 px-5 py-5">
            <h3>Update Theater</h3>
            <form action="" method="post">
                <input type="hidden" name="theaterid" value="<?=$theater_data['theaterid']?>">
                
                <div class="form-group mb-4">
                    <label>Select Movie</label>
                    <select name="movieid" class="form-control" required>
                        <?php
                        $movie_sql = "SELECT * FROM movies";
                        $movie_res = mysqli_query($conn, $movie_sql);
                        while($movie = mysqli_fetch_array($movie_res)){
                            $selected = ($movie['movieid'] == $theater_data['movieid']) ? 'selected' : '';
                            echo "<option value='{$movie['movieid']}' $selected>{$movie['title']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label>Show Time</label>
                    <input type="time" class="form-control" name="timing" value="<?=$theater_data['timing']?>" required>
                </div>

                <div class="form-group mb-4">
                    <label>Days</label>
                    <input type="text" class="form-control" name="days" value="<?=$theater_data['days']?>" maxlength="100" required>
                </div>

                <div class="form-group mb-4">
                    <label>Show Date</label>
                    <input type="date" class="form-control" name="date" value="<?=$theater_data['date']?>" required>
                </div>

                <div class="form-group mb-4">
                    <label>Ticket Price</label>
                    <input type="number" class="form-control" name="price" value="<?=$theater_data['price']?>" required>
                </div>

                <div class="form-group mb-4">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location" value="<?=$theater_data['location']?>" maxlength="100" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="update_theater" value="Update Theater">
                    <a href="theaters.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
} 
// Default View for Adding Theater
else { 
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 px-5 " style="padding-top:7rem">
            <h3>Add Theater</h3>
            <form action="" method="post">
                <div class="form-group mb-4">
                    <label>Select Movie</label>
                    <select name="movieid" class="form-control" required>
                        <option value="">Select Movie</option>
                        <?php
                        $sql = "SELECT * FROM movies";
                        $res = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($res)){
                            echo "<option value='{$data['movieid']}'>{$data['title']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label>Show Time</label>
                    <input type="time" class="form-control" name="timing" required>
                </div>

                <div class="form-group mb-4">
                    <label>Days</label>
                    <input type="text" class="form-control" name="days" placeholder="e.g., Mon-Fri" maxlength="100" required>
                </div>

                <div class="form-group mb-4">
                    <label>Show Date</label>
                    <input type="date" class="form-control" name="date" required>
                </div>

                <div class="form-group mb-4">
                    <label>Ticket Price</label>
                    <input type="number" class="form-control" name="price" placeholder="Enter price" required>
                </div>

                <div class="form-group mb-4">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location" placeholder="Enter location" maxlength="100" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="add" value="Add Theater">
                </div>
            </form>
        </div>

        <div class="col-lg-6 px-5" style="padding-top:7rem">
            <h3>Theater List</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Movie</th>
                            <th>Time</th>
                            <th>Days</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT theater.*, movies.title 
                                FROM theater 
                                INNER JOIN movies ON movies.movieid = theater.movieid 
                                ORDER BY theater.theaterid";
                        $res = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($res)){
                            ?>
                            <tr>
                                <td><?=$data['theaterid']?></td>
                                <td><?=$data['title']?></td>
                                <td><?=$data['timing']?></td>
                                <td><?=$data['days']?></td>
                                <td><?=$data['date']?></td>
                                <td>$<?=$data['price']?></td>
                                <td><?=$data['location']?></td>
                                <td>
                                    <a href="?editid=<?=$data['theaterid']?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="?deleteid=<?=$data['theaterid']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this theater?')">Delete</a>
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
// Process Add Theater
if(isset($_POST['add'])){
    $movieid = mysqli_real_escape_string($conn, $_POST['movieid']);
    $timing = mysqli_real_escape_string($conn, $_POST['timing']);
    $days = mysqli_real_escape_string($conn, $_POST['days']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    $sql = "INSERT INTO theater (movieid, timing, days, date, price, location) 
            VALUES ('$movieid', '$timing', '$days', '$date', '$price', '$location')";

    if(mysqli_query($conn, $sql)){
        echo "<script>
            alert('Theater added successfully');
            window.location.href = 'theaters.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error adding theater: " . mysqli_error($conn) . "');
            window.location.href = 'theaters.php';
        </script>";
        exit();
    }
}

// Process Update Theater
if(isset($_POST['update_theater'])){
    $theaterid = mysqli_real_escape_string($conn, $_POST['theaterid']);
    $movieid = mysqli_real_escape_string($conn, $_POST['movieid']);
    $timing = mysqli_real_escape_string($conn, $_POST['timing']);
    $days = mysqli_real_escape_string($conn, $_POST['days']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    $sql = "UPDATE theater SET 
            movieid='$movieid', 
            timing='$timing', 
            days='$days', 
            date='$date', 
            price='$price', 
            location='$location' 
            WHERE theaterid='$theaterid'";

    if(mysqli_query($conn, $sql)){
        echo "<script>
            alert('Theater updated successfully');
            window.location.href = 'theaters.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error updating theater: " . mysqli_error($conn) . "');
            window.location.href = 'theaters.php';
        </script>";
        exit();
    }
}

// Process Delete Theater
if(isset($_GET['deleteid'])){
    $theaterid = mysqli_real_escape_string($conn, $_GET['deleteid']);
    
    $sql = "DELETE FROM theater WHERE theaterid='$theaterid'";
    
    if(mysqli_query($conn, $sql)){
        echo "<script>
            alert('Theater deleted successfully');
            window.location.href = 'theaters.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error deleting theater: " . mysqli_error($conn) . "');
            window.location.href = 'theaters.php';
        </script>";
        exit();
    }
}
?>