<?php
	include("../function.php");
	session_start();

	$id_cus = $_SESSION['id'];
	$query = "UPDATE customers SET status_order = 'bayar' WHERE id=$id_cus";
	mysqli_query($conn, $query);
	header("location: ../checkout.php");