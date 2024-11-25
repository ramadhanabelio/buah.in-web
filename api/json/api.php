<?php
require_once "method_api.php";
$buah = new Buah();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {

	case 'GET':
		if (!empty($_GET["id"])) {
			$id = intval($_GET["id"]);
			$buah->get_buah($id);
		} else {
			$buah->get_full_buah();
		}
		break;

	case 'POST':
		if (!empty($_GET["id"])) {
			$id = intval($_GET["id"]);
			$buah->update_buah($id);
		} else {
			$buah->insert_buah();
		}
		break;

	case 'DELETE':
		$id = intval($_GET["id"]);
		$buah->delete_buah($id);
		break;

	default:

		// Invalid Request Method
		header("HTTP/1.0 405 Method Not Allowed");
		break;
		break;
}
