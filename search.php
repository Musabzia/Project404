<?php
include('connect.php');

// Get the search query
$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

// Fetch movies matching the search query
$sql = "SELECT movies.*, categories.catname 
        FROM movies
        INNER JOIN categories ON categories.catid = movies.catid
        WHERE movies.title LIKE '%$query%'";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include('header.php'); ?>

    <section class="w3l-grids">
        <div class="grids-main py-5">
            <div class="container py-lg-4">
                <div class="headerhny-title">
                    <h3 class="hny-title">Search Results for "<?= $query ?>"</h3>
                </div>
                <div class="w3l-populohny-grids">
                    <?php
                    
                    if (mysqli_num_rows($res) > 0) {
                        while ($data = mysqli_fetch_array($res)) {
                    ?>
                            <div class="item vhny-grid">
                                <div class="box16 mb-0">
                                    <figure>
                                        <img class="img-fluid" src="admin/uploads/<?= $data['image'] ?>" alt="<?= $data['title'] ?>">
                                    </figure>
                                    <a href=".movieModal<?= $data['movieid'] ?>" data-toggle="modal">
                                        <div class="box-content">
                                            <h3 class="title"><?= $data['title'] ?></h3>
                                            <p><?= $data['rating'] ?></p>
                                        </div>
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade movieModal<?= $data['movieid'] ?>" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" id="mymodalcontent">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="exampleModalLongTitle">Description</h4>
                                                    <button type="button" class="closebtn" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" id="dynamic-content">
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
                                                    <!-- Button to Watch Trailer -->
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#trailerModal" onclick="setTrailer('admin/uploads/<?= $data['trailer'] ?>')">Watch Trailer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal end -->
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No movies found.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>
<script src="assets/js/jquery-1.9.1.min.js"></script>
<script src="assets/js/easyResponsiveTabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		//Horizontal Tab
		$('#parentHorizontalTab').easyResponsiveTabs({
			type: 'default', //Types: default, vertical, accordion
			width: 'auto', //auto or any width like 600px
			fit: true, // 100% fit in a container
			tabidentify: 'hor_1', // The tab groups identifier
			activate: function (event) { // Callback function if tab is switched
				var $tab = $(this);
				var $info = $('#nested-tabInfo');
				var $name = $('span', $info);
				$name.text($tab.text());
				$info.show();
			}
		});
	});
</script>
<!--/theme-change-->
<script src="assets/js/theme-change.js"></script>
<script src="assets/js/owl.carousel.js"></script>
<!-- script for banner slider-->
<script>
	$(document).ready(function () {
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
		})
	})
</script>
<script>
	$(document).ready(function () {
		$('.owl-three').owlCarousel({
			loop: true,
			margin: 20,
			nav: false,
			responsiveClass: true,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplaySpeed: 1000,
			autoplayHoverPause: false,
			responsive: {
				0: {
					items: 2,
					nav: false
				},
				480: {
					items: 2,
					nav: true
				},
				667: {
					items: 3,
					nav: true
				},
				1000: {
					items: 5,
					nav: true
				}
			}
		})
	})
</script>
<script>
	$(document).ready(function () {
		$('.owl-mid').owlCarousel({
			loop: true,
			margin: 0,
			nav: false,
			responsiveClass: true,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplaySpeed: 1000,
			autoplayHoverPause: false,
			responsive: {
				0: {
					items: 1,
					nav: false
				},
				480: {
					items: 1,
					nav: false
				},
				667: {
					items: 1,
					nav: true
				},
				1000: {
					items: 1,
					nav: true
				}
			}
		})
	})
</script>
<!-- script for owlcarousel -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script>
	$(document).ready(function () {
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

		$('.popup-with-move-anim').magnificPopup({
			type: 'inline',

			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,

			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-slide-bottom'
		});
	});
</script>
<!-- disable body scroll which navbar is in active -->
<script>
	$(function () {
		$('.navbar-toggler').click(function () {
			$('body').toggleClass('noscroll');
		})
	});
</script>
<!-- disable body scroll which navbar is in active -->

<!--/MENU-JS-->
<script>
	$(window).on("scroll", function () {
		var scroll = $(window).scrollTop();

		if (scroll >= 80) {
			$("#site-header").addClass("nav-fixed");
		} else {
			$("#site-header").removeClass("nav-fixed");
		}
	});

	//Main navigation Active Class Add Remove
	$(".navbar-toggler").on("click", function () {
		$("header").toggleClass("active");
	});
	$(document).on("ready", function () {
		if ($(window).width() > 991) {
			$("header").removeClass("active");
		}
		$(window).on("resize", function () {
			if ($(window).width() > 991) {
				$("header").removeClass("active");
			}
		});
	});
</script>

<script src="assets/js/bootstrap.min.js"></script>