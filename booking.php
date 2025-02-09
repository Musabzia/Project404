<?php

include('connect.php'); // Include database connection

if (!isset($_SESSION['user_id'])) {  // Changed from userid to user_id to match login
  echo "<script>alert('Please login first!');</script>";
  echo "<script>window.location.href='signin.php';</script>";
  exit();
}

$theaterid = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking</title>
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
</head>
<body>
    
<section id="team" class="team section-bg">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
            <h2>Ticket Booking for Theater</h2>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <form action="booking.php" method="post">
                    <div class="row">
                        <input type="hidden" name="theaterid" value="<?=$theaterid?>">
                        <div class="col form-group mb-3">
                            <input type="text" class="form-control" name="person" placeholder="Enter no of People" required>
                        </div>
                        <div class="col form-group mb-3">
                            <input type="date" class="form-control" name="date" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="ticketbook">Ticket Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
if(isset($_POST['ticketbook'])){
    // Validate and sanitize inputs
    $person = mysqli_real_escape_string($conn, $_POST['person']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $theaterid = mysqli_real_escape_string($conn, $_POST['theaterid']);
    
    // Get user ID from session - changed to match login system
    $userid = $_SESSION['user_id'];  // Changed from userid to user_id

    // Prepare the SQL statement
    $sql = "INSERT INTO `booking` (`theaterid`, `bookingdate`, `person`, `userid`, `status`) 
            VALUES ('$theaterid', '$date', '$person', '$userid', '0')";

    // Execute query
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Ticket booked successfully!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error booking ticket: " . mysqli_error($conn) . "');</script>";
    }
}
?>

</body>
</html>