<?php 
include('../connect.php');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
</head>
<body>

<?php include('header.php') ?>

<div class="container" style="margin-top:100px!important;">
    <form action="viewbookings.php" method="post">
        <div class="row">
            <div class="col-lg-3">
                <input type="date" name="start" class="form-control">
            </div>
            <div class="col-lg-3">
                <input type="date" name="end" class="form-control">
            </div>
            <div class="col-lg-3">
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="0">Pending</option>
                    <option value="1">Approved</option>
                </select>
            </div>
            <div class="col-lg-3">
                <input type="submit" name="btnsearch" value="Search" class="btn btn-success">
            </div>
        </div>
    </form>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Movie Title</th>
                        <th>Category</th>
                        <th>Booking Date</th>
                        <th>Days/Time</th>
                        <th>Number of People</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $total_sale = 0;
                
                if(isset($_POST['btnsearch'])) {
                    $start = $_POST['start'];
                    $end = $_POST['end'];
                    $status = $_POST['status'];

                    $sql = "SELECT booking.bookingid, booking.bookingdate, booking.person, 
                           theater.timing, theater.days, theater.price, theater.location, 
                           movies.title, categories.catname, userdata.name as username,
                           booking.status
                           FROM booking
                           INNER JOIN theater ON theater.theaterid = booking.theaterid
                           INNER JOIN userdata ON userdata.userid = booking.userid
                           INNER JOIN movies ON movies.movieid = theater.movieid
                           INNER JOIN categories ON categories.catid = movies.catid
                           WHERE booking.bookingdate BETWEEN '$start' AND '$end' 
                           AND booking.status = '$status'
                           ORDER BY booking.bookingid";
                } else {
                    $sql = "SELECT booking.bookingid, booking.bookingdate, booking.person, 
                           theater.timing, theater.days, theater.price, theater.location, 
                           movies.title, categories.catname, userdata.name as username,
                           booking.status
                           FROM booking
                           INNER JOIN theater ON theater.theaterid = booking.theaterid
                           INNER JOIN userdata ON userdata.userid = booking.userid
                           INNER JOIN movies ON movies.movieid = theater.movieid
                           INNER JOIN categories ON categories.catid = movies.catid
                           ORDER BY booking.bookingid";
                }

                $res = mysqli_query($conn, $sql);
                if ($res === false) {
                    die("Query failed: " . mysqli_error($conn));
                }

                if(mysqli_num_rows($res) > 0) {
                    while($data = mysqli_fetch_array($res)) {
                        $total_sale += $data['price'];
                        ?>
                        <tr>
                            <td><?= $data['bookingid'] ?></td>
                            <td><?= $data['title'] ?></td>
                            <td><?= $data['catname'] ?></td>
                            <td><?= $data['bookingdate'] ?></td>
                            <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>
                            <td><?= $data['person'] ?></td>
                            <td>Rs. <?= $data['price'] ?></td>
                            <td><?= $data['location'] ?></td>
                            <td><?= $data['username'] ?></td>
                            <td>
                                <?php if($data['status'] == 0): ?>
                                    <span class="btn btn-warning btn-sm">Pending</span>
                                <?php else: ?>
                                    <span class="btn btn-success btn-sm">Approved</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($data['status'] == 1): ?>
                                    <button type="button" class="btn btn-light btn-sm" disabled>Completed</button>
                                <?php else: ?>
                                    <a href='viewbookings.php?bookingid=<?= $data['bookingid'] ?>' 
                                       class='btn btn-primary btn-sm'>Approve</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    if(isset($_POST['btnsearch'])) {
                        echo "<tr><td colspan='11' class='text-end'><strong>Total Sale: Rs. " . 
                             number_format($total_sale, 2) . "</strong></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='11' class='text-center'>No bookings found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php') ?>

</body>
</html>

<?php
if(isset($_GET['bookingid'])) {
    $bookingid = mysqli_real_escape_string($conn, $_GET['bookingid']);
    $sql = "UPDATE `booking` SET `status` = 1 WHERE bookingid = '$bookingid'";
    
    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Booking approved successfully!');</script>";
        echo "<script>window.location.href='viewbookings.php';</script>";
    } else {
        echo "<script>alert('Error approving booking: " . mysqli_error($conn) . "');</script>";
    }
}
?>