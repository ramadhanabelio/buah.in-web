<?php
$conn = mysqli_connect("localhost", "root", "", "buah.in");

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function cari($keyword)
{
	$sql = "SELECT * FROM tbl_buah WHERE nama LIKE '%$keyword%'";
	return query($sql);
}

function tambah($data)
{
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);
	$link_gambar = htmlspecialchars($data["link_gambar"]);

	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO tbl_buah
				VALUES
			('', '$nama', '$deskripsi', '$gambar', '$link_gambar')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload()
{
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	if ($error === 4) {
		echo "<script>
				alert('Silahkan pilih gambar terlebih dahulu!');
			</script>";
		return false;
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('Yang anda upload bukan gambar!');
			</script>";
		return false;
	}

	if ($ukuranFile > 3000000) {
		echo "<script>
				alert('Ukuran gambar terlalu besar!');
			</script>";
		return false;
	}

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);

	return $namaFileBaru;
}

function ubah($data)
{
	global $conn;

	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);
	$link_gambar = htmlspecialchars($data["link_gambar"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query = "UPDATE tbl_buah SET
				nama = '$nama',
				deskripsi = '$deskripsi',
				link_gambar = '$link_gambar',
				gambar = '$gambar'
			WHERE id = $id
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM tbl_buah WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function registrasi($data)
{
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	$result = mysqli_query($conn, "SELECT username FROM tbl_admin WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username sudah terdaftar!')
		</script>";
		return false;
	}

	if ($password !== $password2) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		</script>";
		return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO tbl_admin VALUES('', '$username', '$password')");

	return mysqli_affected_rows($conn);
}
