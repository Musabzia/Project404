<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Signin</title>
	<link rel="stylesheet" type="text/css" href="assets/css/as-alert-message.min.css">
	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style-starter.css">
	<link rel="stylesheet" type="text/css" href="assets/css/sign-in.css">
</head>

<body>
	<div class="container_signup_signin" id="container_signup_signin">
		<div class="form-container sign-up-container">
			<form name="sign-up-form" action="" method="POST">
				<h1>Create Account</h1>
				<div class="social-container">
					<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
					<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<span>or use your email for registration</span>
				<input name="sign-up-name" type="text" placeholder="Name" required />
				<input name="sign-up-email" type="email" placeholder="Email" required />
				<input name="sign-up-passwd" type="password" placeholder="Password" required />
				<button type="submit" name="sign-up">Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form name="sign-in-form" style="color: var(--theme-title);" action="" method="POST">
				<h1>Sign in</h1>
				<div class="social-container">
					<a href="#" class="social" style="color: var(--theme-title);"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="social" style="color: var(--theme-title);"><i
							class="fab fa-google-plus-g"></i></a>
					<a href="#" class="social" style="color: var(--theme-title);"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<span>or use your account</span>
				<input name="sign-in-email" type="email" placeholder="Email" required />
				<input name="sign-in-passwd" type="password" placeholder="Password" required />

				<?php if(isset($_POST['sign-in'])): ?>
					<div id="error-message" style="color: red; margin-top: 5px;">Invalid email or password</div>
				<?php endif; ?>
				
				<a href="#">Forgot your password?</a>
				<button type="submit" name="sign-in">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your login details</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>Register and book your tickets now!!!</p>
					<button type="button" class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "moviehere";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// SIGN UP OR REGISTER

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign-up'])) {
		$name = $_POST['sign-up-name'];
		$email = $_POST['sign-up-email']; 
		$password = $_POST['sign-up-passwd'];

		$sql = "INSERT INTO userdata (name, email, password) VALUES ('$name', '$email', '$password')";
		
		if($conn->query($sql) === TRUE) {
			echo "<script>alert('Registration successful!');</script>";
		} else {
			echo "<script>alert('Error: " . $conn->error . "');</script>";
		}
	}

	// SIGN IN 
	
	session_start();

	if (isset($_POST['sign-in'])) {
		$email = $_POST['sign-in-email'];
		$password = $_POST['sign-in-passwd'];

		// Use prepared statements to prevent SQL injection
		$stmt = $conn->prepare("SELECT * FROM userdata WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $password);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$user = $result->fetch_assoc();
			$_SESSION['user_id'] = $user['userid'];
			$_SESSION['type'] = $user['rotetype'];
			
			if ($_SESSION['type'] == 1) {
				header("Location: admin/dashboard.php");
			} else {
				header("Location: index.php");
			}
			exit();
		}
	}
	
	$conn->close();
	?>
	
	<script type="text/javascript" src="assets/js/as-alert-message.min.js"></script>
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<!--/theme-change-->
	<script src="assets/js/theme-change.js"></script>
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

	<script type="text/javascript" src="assets/js/sign-in.js"></script>

</body>

</html>