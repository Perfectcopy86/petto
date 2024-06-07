<?php

	$dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $mydb = 'db_petto';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $mydb);

    if(! $conn){
        die('Could not connect:' . mysql_error());
    }

    function signin($data) {

        global $conn;
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cek_username = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

        if( mysqli_num_rows($cek_username) === 1 ) {
            $row = mysqli_fetch_assoc($cek_username);
            // cek password
            if( password_verify($password, $row['password']) ) {

                $_SESSION["signin"] = true;
                $_SESSION["username"] = $row['username'];
                $_SESSION["nama"] = $row['nama'];
                $_SESSION["status"] = $row['status'];
                header('Location: admin.php');
                exit;
            } 
	    }
        else {
            setcookie("message", "Username or password incorrect", time()+60);
            header("location: signin.php");
        }

    }

    function signup_cus($data){
        global $conn;

        $name = ($_POST["name"]);
        $alamat = ($_POST["alamat"]);
        $phone = ($_POST["phone"]);
        $email = ($_POST["email"]);
        $username = ($_POST["username"]);
        $password = ($_POST["password"]);
        $re_password = ($_POST["re_password"]);
        // $status = 

        $cek_username = mysqli_query($conn, "SELECT * FROM customers WHERE username = '$username'");
        if(mysqli_num_rows($cek_username) === 1) {
            setcookie("message", "Username already used", time()+60);
            header("location: signup_cus.php");
            return false;
        }

        if($password !== $re_password){
            setcookie("message", "Password incorrect", time()+60);
            header("location: signup_cus.php");
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO customers VALUES ('', '$name', '$alamat', '$phone', '$email', '$username', '$password', 'customer', 0, 0, 'none')";
    
        mysqli_query($conn, $sql);
    
        return mysqli_affected_rows($conn);
    }

    function signin_cus($data) {

        global $conn;
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cek_username = mysqli_query($conn, "SELECT * FROM customers WHERE username = '$username'");

        if( mysqli_num_rows($cek_username) === 1 ) {
            $row = mysqli_fetch_assoc($cek_username);
            // cek password
            if( password_verify($password, $row['password']) ) {

                $_SESSION["signin"] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION["username"] = $row['username'];
                $_SESSION["nama"] = $row['nama'];
                $_SESSION["alamat"] = $row['alamat'];
                $_SESSION["phone"] = $row['phone'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["status"] = $row['status'];
                header('Location: index.php');
                exit;
            } 
        }
        else {
            setcookie("message", "Username or password incorrect", time()+60);
            header("location: signin_cus.php");
        }

    }

    function readQuery($table)
    {
        global $conn;
        $query = "SELECT * FROM $table;";
        $result = mysqli_query($conn, $query);
        $records = [];
        while ($record = mysqli_fetch_assoc($result)) {
            $records[] = $record;
        }
        return $records;
    }

    function readQueryJenis($jenis)
    {
        global $conn;
        $query = "SELECT * FROM produk WHERE jenis=$jenis";
        $result = mysqli_query($conn, $query);
        $records = [];
        while ($record = mysqli_fetch_assoc($result)) {
            $records[] = $record;
        }
        return $records;
    }

    function readQueryId($id)
    {
        global $conn;
        $query = "SELECT * FROM jenis_produk WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $record = mysqli_fetch_assoc($result);
        return $record;
    }

    function add($data)
    {
        global $conn;
        $tmp_file = $_FILES['foto']['tmp_name'];
        $nm_file = $_FILES['foto']['name'];
        $ukuran_file = $_FILES['foto']['size'];
        $size = 10000000;

        $dir = "foto/$nm_file";
        move_uploaded_file($tmp_file, $dir);

        $nama = $_POST['nama_produk'];
        $harga = $_POST['harga_produk'];
        $jenis = $_POST['jenis_produk'];
        $banyak = $_POST['banyak_produk'];

        $query = "INSERT INTO produk values ('', '$nm_file', '$nama', '$harga', '$jenis', '$banyak')";
        $result = mysqli_query($conn, $query);
        $isSucceed = mysqli_affected_rows($conn);
        return $isSucceed;
    }

    function searchProduk($jenis, $keyword){
        global $conn;
        $query = "SELECT * FROM produk WHERE nama LIKE '$keyword' AND jenis=$jenis;";
        $result = mysqli_query($conn, $query);
        $record = [];
        while($record = mysqli_fetch_assoc($result)){
            $records[] = $record;
        }

        return $records;
    }

    function searchProduk0($keyword){
        global $conn;
        $query = "SELECT * FROM produk WHERE nama LIKE '$keyword';";
        $result = mysqli_query($conn, $query);
        $record = [];
        while($record = mysqli_fetch_assoc($result)){
            $records[] = $record;
        }

        return $records;
    }
    

    function delete_data($table, $id){
        global $conn;
        $query = "DELETE FROM $table WHERE id=$id";
        $result = mysqli_query($conn, $query);
    }

    function delete_data_laporan($table, $id_cus, $id_produk){
        global $conn;
        $query = "DELETE FROM $table WHERE id_customers=$id_cus AND id_produk=$id_produk";
        $result = mysqli_query($conn, $query);
    }

     function update_data($id){
        global $conn;
        $query = "UPDATE produk SET WHERE id=$id";
        $result = mysqli_query($conn, $query);
    }