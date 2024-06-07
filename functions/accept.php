<?php
	include("../function.php");
	session_start();

	$id_cus = $_GET['id'];
	$query = "INSERT INTO laporan_pembelian SELECT p.id, p.id_customers, p.id_produk, p.harga_produk, p.banyak_produk, p.total, NOW() FROM orders p WHERE id_customers=$id_cus";
	$query2 = "UPDATE customers SET status_order = 'konfirmasi' WHERE id=$id_cus";
	mysqli_query($conn, $query);
	mysqli_query($conn, $query2);
	header("location: ../konfirmasi_bayar.php");