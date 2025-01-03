<?php
require '../functions.php';

class Buah
{
	public function get_full_buah()
	{
		global $conn;

		$query = " SELECT * FROM tbl_buah ";
		$data = array();
		$result = $conn->query($query);

		while ($row = mysqli_fetch_object($result)) {
			$data[] = $row;
		}
		$response = array(
			'status' => 1,
			'message' => 'Berhasil mendapatkan seluruh data',
			'data' => $data
		);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function get_buah($id = 0)
	{
		global $conn;

		$query = " SELECT * FROM tbl_buah ";
		if ($id != 0) {
			$query .= " WHERE id = " . $id . " LIMIT 1";
		}
		$data = array();
		$result = $conn->query($query);
		while ($row = mysqli_fetch_object($result)) {
			$data[] = $row;
		}
		$response = array(
			'status' => 1,
			'message' => 'Berhasil mendapatkan data',
			'data' => $data
		);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function insert_buah()
	{
		global $conn;

		$arrcheckpost = array('nama' => '', 'deskripsi' => '', 'gambar' => '', 'link_gambar' => '');
		$hitung = count(array_intersect_key($_POST, $arrcheckpost));
		if ($hitung == count($arrcheckpost)) {
			$result = mysqli_query($conn, " INSERT INTO tbl_buah SET
			nama = '$_POST[nama]',
			deskripsi = '$_POST[deskripsi]',
			gambar = '$_POST[gambar]',
			link_gambar = '$_POST[link_gambar]' ");

			if ($result) {
				$response = array(
					'status' => 1,
					'message' => 'Berhasil menambahkan data'
				);
			} else {
				$response = array(
					'status' => 0,
					'message' => 'Gagal menambahkan data'
				);
			}
		} else {
			$response = array(
				'status' => 0,
				'message' => 'Parameter tidak cocok'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function update_buah($id)
	{
		global $conn;

		$arrcheckpost = array('nama' => '', 'deskripsi' => '', 'gambar' => '', 'link_gambar' => '');
		$hitung = count(array_intersect_key($_POST, $arrcheckpost));
		if ($hitung == count($arrcheckpost)) {
			$result = mysqli_query($conn, " UPDATE tbl_buah SET
			nama = '$_POST[nama]',
			deskripsi = '$_POST[deskripsi]',
			gambar = '$_POST[gambar]',
			link_gambar = '$_POST[link_gambar]'
			WHERE id = '$id' ");

			if ($result) {
				$response = array(
					'status' => 1,
					'message' => 'Berhasil memperbarui data'
				);
			} else {
				$response = array(
					'status' => 0,
					'message' => 'Gagal memperbarui data'
				);
			}
		} else {
			$response = array(
				'status' => 0,
				'message' => 'Parameter tidak cocok'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function delete_buah($id)
	{
		global $conn;

		$query = " DELETE FROM tbl_buah WHERE id = " . $id;
		if (mysqli_query($conn, $query)) {
			$response = array(
				'status' => 1,
				'message' => 'Berhasil menghapus data'
			);
		} else {
			$response = array(
				'status' => 0,
				'message' => 'Gagal menghapus data'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
