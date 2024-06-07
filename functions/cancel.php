<?php
	include("../function.php");
	session_start();

	$id_cus = $_SESSION['id'];
	$query = "DELETE FROM orders WHERE id_customers=$id_cus";
	$query2 = "UPDATE customers SET total = 0, status_order = 'none', cart = 0 WHERE id=$id_cus";
	mysqli_query($conn, $query);
	mysqli_query($conn, $query2);
	header("location: ../index.php");