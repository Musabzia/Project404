<?php
include ('connect.php');

// Fetch all movies
$sql = "SELECT * FROM movies ORDER BY movieid DESC";
$res = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
</head>

<body>
    <?php include('header.php'); ?>

    <!-- main-slider -->
    <section class="w3l-main-slider position-relative" id="home">
        <!-- [Previous slider code remains unchanged] -->
    </section>
    <!-- //main-slider -->

    <!--/movies -->
    <section class="w3l-grids">
        <div class="grids-main py-5">
            <div class="container py-lg-4">
                <div class="headerhny-title">
                    <div class="w3l-title-grids">
                        <div class="headerhny-left">
                            <h3 class="hny-title">Latest Movies</h3>
                        </div>
                        <div class="headerhny-right text-lg-right">
                            <h4><a class="show-title" href="movies.php">Show all</a></h4>
                        </div>
                    </div>
                </div>

                <!-- Display All Movies -->
                <div class="w3l-populohny-grids">
                    <?php while ($data = mysqli_fetch_array($res)): ?>
                        <div class="item vhny-grid">
                            <div class="box16 mb-0">
                                <figure>
                                    <img class="img-fluid" src="admin/uploads/<?= $data['image'] ?>" alt="<?= $data['title'] ?>">
                                </figure>
                                <a href="movies.php?movieid=<?= $data['movieid'] ?>">
                                    <div class="box-content">
                                        <h1 class="title"><?= $data['title'] ?></h1>
                                    </div>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade movieModal<?= $data['movieid'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" id="mymodalcontent">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Description</h4>
                                                <button type="button" class="closebtn" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="admin/uploads/<?= $data['image'] ?>" class="img-fluid modalimg" alt="<?= $data['title'] ?>" />
                                                <p>
                                                    <h3>Release Date: <?= $data['releasedate'] ?></h3>
                                                </p>
                                                <h4>About Movie:</h4>
                                                <p><?= $data['description'] ?></p>
                                                <h4>Rating:</h4>
                                                <p><?= $data['rating'] ?></p>
                                            </div>
                                            <div class="bookbtn">
                                                <button type="button" class="btn btn-success" onclick="location.href='ticket-booking.html';">Book</button>
                                            </div>
                                            <div class="w-trailer pb-3">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#trailerModal" onclick="setTrailer('admin/uploads/<?= $data['trailer'] ?>')">Watch Trailer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Trailer Modal -->
    <div class="modal fade" id="trailerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <!-- [Previous trailer modal code remains unchanged] -->
    </div>

    <?php include('footer.php'); ?>

    <!-- Scripts section remains unchanged -->
	 <!-- Scripts -->
	 <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/js/easyResponsiveTabs.js"></script>
    <script src="assets/js/theme-change.js"></script>
    <script src="assets/js/owl.carousel.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script>
        function setTrailer(videoUrl) {
            document.getElementById('trailerVideo').src = videoUrl;
        }

        $('#trailerModal').on('hidden.bs.modal', function () {
            document.getElementById('trailerVideo').src = "";
        });

        $(document).ready(function () {
            // Owl Carousel Initialization
            $('.owl-one').owlCarousel({
                stagePadding: 280,
                loop: true,
                margin: 20,
                nav: true,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 1,
                        stagePadding: 40,
                        nav: false
                    },
                    480: {
                        items: 1,
                        stagePadding: 60,
                        nav: true
                    },
                    667: {
                        items: 1,
                        stagePadding: 80,
                        nav: true
                    },
                    1000: {
                        items: 1,
                        nav: true
                    }
                }
            });

            // Popup initialization
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });

            // Navbar scroll
            $(window).on("scroll", function () {
                var scroll = $(window).scrollTop();
                if (scroll >= 80) {
                    $("#site-header").addClass("nav-fixed");
                } else {
                    $("#site-header").removeClass("nav-fixed");
                }
            });

            // Navigation toggle
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            });
        });
    </script>
</body>
</html>

