<?php
	include("../function.php");
	session_start();

	$id = $_GET['id_produk'];
	$id_cus = $_SESSION['id'];
	$harga = $_GET['harga_produk'];
	$query = "UPDATE orders SET banyak_produk = banyak_produk - 1, total = total - harga_produk WHERE id_customers=$id_cus AND id_produk=$id";
	$query2 = "UPDATE customers SET cart = cart - 1 WHERE id=$id_cus";
	$query3 = "UPDATE customers SET total = total - $harga WHERE id=$id_cus";
	mysqli_query($conn, $query);
	mysqli_query($conn, $query2);
	mysqli_query($conn, $query3);
	$query4 = "SELECT total FROM customers WHERE id=$id_cus";
	$result = mysqli_query($conn, $query4);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row['total'] == 0)
    {
    	$query5 = "UPDATE customers SET status_order = 'none' WHERE id=$id_cus";
    	mysqli_query($conn, $query5);
    }
	header("location: ../cart.php");