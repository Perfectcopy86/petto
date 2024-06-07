<?php

	include("../function.php");
	session_start();

	$id_cus = $_SESSION['id'];
	$query = "UPDATE customers SET status_order='checkout', cart = 0, total = total + 5000 WHERE id=$id_cus";
	$query2 ="UPDATE orders SET status = 'checkout' WHERE id_customers=$id_cus";
	mysqli_query($conn, $query);
	mysqli_query($conn, $query2);
    header("location: ../checkout.php");