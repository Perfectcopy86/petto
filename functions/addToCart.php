<?php
	include("../function.php");
	session_start();

    if(!isset($_SESSION['username'])){
        header("location: ../signin_cus.php");
    }

	$id = $_GET['id_produk'];
    $harga = $_GET['harga_produk'];
	$id_cus = $_SESSION['id'];
	$url = $_GET['url'];
	$sql = "SELECT id_customers, id_produk FROM orders WHERE id_customers=$id_cus AND id_produk=$id";
	$result = mysqli_query($conn, $sql);
    $isSucceed = mysqli_affected_rows($conn);

    if($id > 0)
    {
        if(!isset($_SESSION['id']))
        {
            header("location: ../signin_cus.php");
        }
        else if($isSucceed)
        {
        	$query = "UPDATE orders SET banyak_produk = banyak_produk + 1, total = total + harga_produk WHERE id_customers=$id_cus AND id_produk=$id";
            $query2 = "UPDATE customers SET cart = cart + 1 WHERE id=$id_cus";
            $query3 = "UPDATE customers SET total = total + $harga WHERE id=$id_cus";
            $query4 = "UPDATE customers SET status_order = 'cart' WHERE id=$id_cus";
        	mysqli_query($conn, $query);
            mysqli_query($conn, $query2);
            mysqli_query($conn, $query3);
            mysqli_query($conn, $query4);
    		header("location: ../$url.php");
        }
        else
        {
        	$query = "INSERT INTO orders(id, id_customers, id_produk, harga_produk, banyak_produk, total, status) SELECT '', $id_cus, produk.id, produk.harga, 1, produk.harga, 'cart' FROM produk WHERE produk.id=$id";
            $query2 = "UPDATE customers SET status_order = 'cart' WHERE id=$id_cus";
    		mysqli_query($conn, $query);
            mysqli_query($conn, $query2);
    		header("location: ../$url.php");
        }
    }