<?php
	include("../function.php");
	session_start();

	$id = $_GET['id_produk'];
	$id_cus = $_SESSION['id'];
	$banyak = $_GET['banyak'];
	$total = $_GET['total'];
	$query = "DELETE FROM orders WHERE id_customers=$id_cus AND id_produk=$id";
	// $query2 = "UPDATE customers set cart = cart - $banyak AND total = total - $total";
	mysqli_query($conn, $query);
	// mysqli_query($conn, $query2);
	$query4 = "SELECT total FROM customers WHERE id=$id_cus";
	$result = mysqli_query($conn, $query4);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row['total'] == 0)
    {
    	$query5 = "UPDATE customers SET status_order = 'none' WHERE id=$id_cus";
    	mysqli_query($conn, $query5);
    }
	header("location: ../cart.php");