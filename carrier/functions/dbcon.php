<?php
	$host = "127.0.0.1";
	$user = "root";
	$password = "";
	$db = "biddingsystemdb";

	$conn = new mysqli($host, $user, $password, $db);

	if($conn->connect_error) {
		die("connection failed: " . $conn->connect_error);
	}
?>
