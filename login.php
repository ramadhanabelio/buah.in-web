<?php
session_start();
require 'functions.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	$result = mysqli_query($conn, "SELECT username FROM tbl_admin WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

if (isset($_SESSION["login"])) {
	header("Location: dashboard.php");
	exit;
}

if (isset($_POST["login"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];
	$result = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE username = '$username'");

	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {
			$_SESSION["login"] = true;
			if (isset($_POST['remember'])) {
				setcookie('id', $row['id'], time() + 60);
				setcookie('key', hash('sha256', $row['username']), time() + 60);
			}
			header("Location: dashboard.php");
		} else {
			header("Location: login.php?pesan=gagal");
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Buah.in · Login</title>
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<!-- CSS Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<!-- Icon Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- My CSS -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/auth.css">
</head>

<body class="bg-secondary">
	<main class="form-auth w-100 m-auto">
		<div class="container bg-light rounded shadow">
			<form action="" method="post">
				<div class="text-center">
					<img class="mb-3 mt-4" src="img/brand.png" alt="Logo Buah.in" width="180">
				</div>

				<?php
				if (isset($_GET['pesan'])) {
					if ($_GET['pesan'] == "gagal") {
						echo '<div class="alert alert-danger text-center" role="alert">
				<b class="alert-link">LOGIN GAGAL</b>, Periksa lagi Username atau Password anda!
				</div>';
					} else if ($_GET['pesan'] == "keluar") {
						echo '<div class="alert alert-success text-center" role="alert">
				Anda telah berhasil Keluar
				</div>';
					} else if ($_GET['pesan'] == "belum_login") {
						echo '<div class="alert alert-warning text-center" role="alert">
				Silahkan Masuk terlebih dahulu!
				</div>';
					}
				}
				?>

				<!-- Username Start -->
				<div class="col-16 mb-3">
					<div class="input-group">
						<div class="input-group-text">
							<div class="input-group-prepend">
								<i class="fa fa-user"></i>
							</div>
						</div>
						<input class="form-control" type="text" name="username" id="username" placeholder="Username">
					</div>
				</div>
				<!-- Username End -->

				<!-- Password Start -->
				<div class="col-16 mb-3">
					<div class="input-group">
						<div class="input-group-text">
							<div class="input-group-prepend">
								<i class="fa fa-lock"></i>
							</div>
						</div>
						<input class="form-control" type="password" name="password" id="password" placeholder="Password">
					</div>
				</div>
				<!-- Password End -->

				<!-- Remember me Start -->
				<div class="col-16 mb-3">
					<input class="form-check-input me-1" type="checkbox" name="remember" id="remember">
					<label class="form-check-label" for="remember">Remember me</label>
				</div>
				<!-- Remember me End -->

				<input class="w-100 mb-3 btn btn-green" type="submit" value="Masuk" name="login"></input>

				<!-- <p class="text-center">Belum punya Akun? <a href="register.php" class="fw-bold green">Daftar</a></p> -->
				<p class="text-center pb-4">Kembali ke <a href="index.php" class="fw-bold green">Beranda</a> </p>
			</form>
		</div>
	</main>

	<!-- JS Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>