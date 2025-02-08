<?php
include('connect.php');

// Fetch all theaters with movie and category information
$theater_sql = "SELECT theater.*, movies.*, categories.catname
                FROM theater
                INNER JOIN movies ON movies.movieid = theater.movieid
                INNER JOIN categories ON categories.catid = movies.catid
                ORDER BY categories.catname, theater.theaterid DESC";
$theater_result = mysqli_query($conn, $theater_sql);

// Group theaters by category
$theaters_by_category = [];
while ($data = mysqli_fetch_array($theater_result)) {
    $category = $data['catname'];
    if (!isset($theaters_by_category[$category])) {
        $theaters_by_category[$category] = [];
    }
    $theaters_by_category[$category][] = $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theater Listings</title>
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include('header.php'); ?>

    <!-- Breadcrumbs -->
    <div class="w3l-breadcrumbs">
        <nav id="breadcrumbs" class="breadcrumbs">
            <div class="container page-wrapper">
                <a href="index.php">Home</a> » <span class="breadcrumb_last">Theaters</span>
            </div>
        </nav>
    </div>

    <!-- Theater Listings -->
    <section class="w3l-grids">
        <div class="grids-main py-5">
            <div class="container py-lg-4">
                <div class="section-title mb-4">
                    <h3>Our <span>Theaters</span></h3>
                </div>

                <?php foreach ($theaters_by_category as $category => $theaters): ?>
                <div class="category-section mb-5">
                    <h2 class="category-title h4 mb-4"><?= htmlspecialchars($category) ?></h2>
                    <div class="row">
                        <?php foreach ($theaters as $theater): ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="theater-card">
                                <div class="theater-image">
                                    <img src="admin/uploads/<?= htmlspecialchars($theater['image']) ?>" 
                                         alt="<?= htmlspecialchars($theater['title']) ?>"
                                         class="img-fluid rounded">
                                         
                                    <div class="theater-overlay">
                                    <br>
                                        <a href="admin/uploads/<?= htmlspecialchars($theater['trailer']) ?>" 
                                           class="btn btn-primary trailer-btn"
                                           data-toggle="modal" 
                                           data-target="#trailerModal" 
                                           onclick="setTrailer('admin/uploads/<?= htmlspecialchars($theater['trailer']) ?>')">
                                            Watch Trailer
                                        </a>
                                    </div>
                                </div>
                                <div class="theater-info p-3">
                                    <h5 class="movie-title"><?= htmlspecialchars($theater['title']) ?></h5>
                                    <div class="theater-details">
                                        <p><i class="fa fa-clock-o"></i> <?= htmlspecialchars($theater['timing']) ?></p>
                                        <p><i class="fa fa-calendar"></i> <?= htmlspecialchars($theater['days']) ?></p>
                                        <p><i class="fa fa-calendar-check-o"></i> <?= htmlspecialchars($theater['date']) ?></p>
                                        <p><i class="fa fa-map-marker"></i> <?= htmlspecialchars($theater['location']) ?></p>
                                        <p class="price">Ticket Price: Rs.<?= htmlspecialchars($theater['price']) ?></p>
                                    </div>
                                    <a href="booking.php?id=<?= urlencode($theater['theaterid']) ?>" 
                                       class="btn btn-primary btn-block mt-3">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Trailer Modal -->
    <div class="modal fade" id="trailerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Movie Trailer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="trailerVideo" width="100%" height="500" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <!-- Scripts -->
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
    function setTrailer(videoUrl) {
        document.getElementById('trailerVideo').src = videoUrl;
    }

    $('#trailerModal').on('hidden.bs.modal', function () {
        document.getElementById('trailerVideo').src = '';
    });

    // Add fixed header on scroll
    $(window).on("scroll", function () {
        if ($(window).scrollTop() >= 80) {
            $("#site-header").addClass("nav-fixed");
        } else {
            $("#site-header").removeClass("nav-fixed");
        }
    });
    </script>
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