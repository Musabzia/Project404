<?php
include ('connect.php');

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Get the current page
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
</head>
<body>
    <header id="site-header" class="w3l-header fixed-top">
        <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
            <div class="container">
                <h1>
                    <a class="navbar-brand" href="index.php">
                        <span class="fa fa-play icon-log" aria-hidden="true"></span> MyShowz
                    </a>
                </h1>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="fa icon-expand fa-bars"></span>
                    <span class="fa icon-close fa-times"></span>    
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item <?php echo ($currentPage == 'movies.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="movies.php">Movies</a>
                        </li>
                        <li class="nav-item <?php echo ($currentPage == 'about.html') ? 'active' : ''; ?>">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item <?php echo ($currentPage == 'Contact_Us.html') ? 'active' : ''; ?>">
                            <a class="nav-link" href="Contact_Us.html">Contact</a>
                        </li>
                        
                        <?php if($isLoggedIn): ?>
                            <li class="nav-item <?php echo ($currentPage == 'booking.php') ? 'active' : ''; ?>">
                                <a class="nav-link" href="booking.php">My Bookings</a>
                            </li>
                            <li class="nav-item <?php echo ($currentPage == 'theaters.php') ? 'active' : ''; ?>">
                                <a class="nav-link" href="theaters.php">Theaters</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <div class="Login_SignUp" id="login">
                                    <a class="nav-link" href="sign_in.php"><i class="fa fa-user-circle-o"></i></a>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- search popup -->
                <div class="search-right">
                    <a href="#search" class="btn search-hny mr-lg-3 mt-lg-0 mt-4" title="search">
                        Search <span class="fa fa-search ml-3" aria-hidden="true"></span>
                    </a>
                    <!-- search popup -->
                    <div id="search" class="pop-overlay">
                        <div class="popup">
                            <form action="#" method="post" class="search-box">
                                <input type="search" placeholder="Search your Keyword" name="search"
                                    required="required" autofocus="">
                                <button type="submit" class="btn">
                                    <span class="fa fa-search" aria-hidden="true"></span>
                                </button>
                            </form>
                            <div class="browse-items">
                                <h3 class="hny-title two mt-md-5 mt-4">Browse all:</h3>
                                <ul class="search-items">
                                    <li><a href="movies.html">Action</a></li>
                                    <li><a href="movies.html">Drama</a></li>
                                    <li><a href="movies.html">Family</a></li>
                                    <li><a href="movies.html">Thriller</a></li>
                                    <li><a href="movies.html">Comedy</a></li>
                                    <li><a href="movies.html">Romantic</a></li>
                                    <li><a href="movies.html">Tv-Series</a></li>
                                    <li><a href="movies.html">Horror</a></li>
                                </ul>
                            </div>
                        </div>
                        <a class="close" href="#close">×</a>
                    </div>
                </div>

                <!-- toggle switch for light and dark theme -->
                <div class="mobile-position">
                    <nav class="navigation">
                        <div class="theme-switch-wrapper">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox">
                                <div class="mode-container">
                                    <i class="gg-sun"></i>
                                    <i class="gg-moon"></i>
                                </div>
                            </label>
                        </div>
                    </nav>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>