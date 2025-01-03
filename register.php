<?php
require 'functions.php';

if (isset($_POST["register"])) {

	if (registrasi($_POST) > 0) {
		echo "<script>
				alert('Akun berhasil didaftarkan!');
				document.location.href = 'login.php';
			</script>";
	} else {
		echo mysqli_error($conn);
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Buah.in · Register</title>
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
					<small id="username-validation" class="form-text text-danger"></small>
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

				<!-- Password Start -->
				<div class="col-16 mb-3">
					<div class="input-group">
						<div class="input-group-text">
							<div class="input-group-prepend">
								<i class="fa fa-lock"></i>
							</div>
						</div>
						<input class="form-control" type="password" name="password2" id="password2" placeholder="Konfirmasi Password">
					</div>
				</div>
				<!-- Password End -->

				<input class="w-100 mb-3 btn btn-green" type="submit" value="Daftar" name="register"></input>

				<p class="text-center pb-4">Sudah punya Akun? <a href="login.php" class="fw-bold green">Masuk</a></p>
			</form>
		</div>
	</main>

	<!-- JS Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>