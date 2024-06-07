<?php
    include("function.php");
    session_start();

    if(!isset($_SESSION['username'])){
        header("location: signin_cus.php");
    }

    $id_cus = $_SESSION['id'];
    $query = "SELECT status_order FROM customers WHERE id=$id_cus";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $status = $row['status_order'];
    if($status == 'checkout' || $status == 'order' || $status == 'bayar' || $status == 'konfirmasi')
    {
        $id_cus = $_SESSION['id'];
        $query = "SELECT p.foto, p.id, c.id_customers, c.id_produk, p.nama, c.harga_produk, c.banyak_produk, c.total FROM produk p INNER JOIN orders c ON p.id=c.id_produk WHERE c.id_customers=$id_cus;";
        $result = mysqli_query($conn, $query);
        $records = [];
        while ($record = mysqli_fetch_assoc($result)) {
            $records[] = $record;
        }
    }
    else
    {
        echo "<script>
                alert('Checkout first!');
                document.location.href = 'cart.php';
            </script>";
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PETTO | CHECKOUT</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <script src="https://kit.fontawesome.com/764f86ebf6.js" crossorigin="anonymous"></script>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style_shop.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/logo petto.png">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-warning font-weight-bold border px-3 mr-1"><i class="fa-solid fa-paw"></i></span>PETTO</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="" class="btn border">
                    <i class="fas fa-shopping-cart text-warning"></i>
                    <span class="badge">
                        <?php
                            if(!isset($_SESSION['username']))
                            {
                               echo "0"; 
                            }
                            else
                            {
                                $id_cus = $_SESSION['id'];
                                $query = "SELECT cart FROM customers WHERE id=$id_cus";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                echo $row['cart'];
                            } 
                        ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-warning text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 287px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Food <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="shop-foods.php" class="dropdown-item">Cat's Food</a>
                                <a href="shop-foods.php" class="dropdown-item">Bird's Food</a>
                                <a href="shop-foods.php" class="dropdown-item">Dog's Food</a>
                                <a href="shop-foods.php" class="dropdown-item">Fish's Food</a>
                            </div>
                        </div>
                        <a href="shop-toys.php" class="nav-item nav-link">Toys</a>
                        <a href="shop-clothes.php" class="nav-item nav-link">Clothes</a>
                        <a href="shop-accessories.php" class="nav-item nav-link">Accessories</a>
                        <a href="shop-vitamin.php" class="nav-item nav-link">Vitamin</a>
                        <a href="shop-grooms.php" class="nav-item nav-link">Grooming Tools</a>
                        <a href="shop-sleeps.php" class="nav-item nav-link">Sleep Tools</a>
                       
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-warning font-weight-bold border px-3 mr-1"><i class="fa-solid fa-paw"></i></span>PETTO</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.php" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <?php
                                if(!isset($_SESSION['username']))
                                {
                                    echo "<a href='signin_cus.php' class='nav-item nav-link '>Login</a>";
                                    echo "<a href='signup_cus.php' class='nav-item nav-link'>Register</a>";
                                }
                                else
                                {
                                    echo "<span class='nav-item nav-link mr-2'>Selamat datang, <strong>" . $_SESSION['nama'] . "</strong></span>";
                                    echo "<a href='functions/logout_cus.php' class='nav-item nav-link btn btn-warning'>Logout</a>";
                                }
                            ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-6">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Details</h4>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Name :</label>
                            <p><strong><?= $_SESSION["nama"] ?></strong></p>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Address :</label>
                            <p><strong><?= $_SESSION["alamat"] ?></strong></p>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Phone :</label>
                            <p><strong><?= $_SESSION["phone"] ?></strong></p>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Email</label>
                            <p><strong><?= $_SESSION["email"] ?></strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-secondary mb-2">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <?php
                            if($status == 'checkout' || $status == 'order')
                            {
                                foreach ($records as $r) : ?>
                                <div class="d-flex justify-content-between">
                                    <div class="col-md-6">
                                        <p><?= $r['nama'] ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><?= $r['banyak_produk'] ?> x <?= $r['harga_produk'] ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Rp.<?= $r['total'] ?></p>
                                    </div>
                                </div>
                                <?php endforeach; } ?>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">
                            <?php
                                if($status == 'checkout' || $status == 'order')
                                {
                                    $id_cus = $_SESSION['id'];
                                    $query = "SELECT total FROM customers WHERE id=$id_cus";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    echo "Rp." . $row['total'];
                                }
                                else
                                {
                                    echo "Rp.0";
                                }
                            ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <?php
                    if($status == 'checkout' || $status == 'order')
                    {
                        echo "<div class='row mb-2'>
                            <div class='col-md-8'>
                                <a href='functions/order.php' class='btn btn-lg btn-block btn-warning font-weight-bold my-3 py-3'>Place Order</a>
                            </div>
                            <div class='col-md-4'>
                                <a href='functions/cancel.php' class='btn btn-lg btn-block btn-danger font-weight-bold my-3 py-3'>Cancel</a>
                            </div>
                        </div>";
                    }
                    else if($status == 'bayar' || $status == 'konfirmasi')
                    {
                        echo "<div class='row mb-2'>
                            <div class='col-md-12'>
                                <a href='#' class='btn btn-lg btn-block btn-warning font-weight-bold my-3 py-3' data-toggle='modal' data-target='#bill'>Bill</a>
                            </div>
                        </div>";
                    }
                ?>
                <?php
                    if($status == 'order')
                    {
                        echo "<div class='card border-secondary mb-5'>
                            <div class='card-header bg-secondary border-0'>
                                <h4 class='font-weight-semi-bold m-0'>Select Payment Method</h4>
                            </div>
                            <div class='card-body'>
                                <div class='row'>
                                    <div class='col-md-3'>
                                        <a href='#' class='btn text-white' style='width: 100%; background-color: #fe0018;' data-toggle='modal' data-target='#linkaja'>Link Aja</a>
                                    </div>
                                    <div class='col-md-3'>
                                        <a href='#' class='btn text-white' style='width: 100%; background-color: #e85d26;' data-toggle='modal' data-target='#bni'>BNI Mobile</a>
                                    </div>
                                    <div class='col-md-3'>
                                        <a href='#' class='btn text-white' style='width: 100%; background-color: #1da29d;' data-toggle='modal' data-target='#bsi'>BSI Mobile</a>
                                    </div>
                                    <div class='col-md-3'>
                                        <a href='#' class='btn text-white' style='width: 100%; background-color: #00aa13;' data-toggle='modal' data-target='#gopay'>Gopay</a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- Checkout End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="index.php" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-warning font-weight-bold border border-white px-3 mr-1"><i class="fa-solid fa-paw"></i></span>PETTO</h1>
                </a>
                <p>Petto merupakan petshop no.1 di Indonesia yang menyediakan kebutuhan hewan dengan kualitas tinggi.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-warning mr-3"></i>Gerlong Street, Bandung, Indonesia</p>
                <p class="mb-2"><i class="fa fa-envelope text-warning mr-3"></i>petto@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-warning mr-3"></i>+62 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.php"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-warning btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="index.php">PETTO</a>. All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-warning back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <div class="modal fade" id="linkaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #fe0018;">
            <h5 class="modal-title text-white" id="exampleModalLabel">Link Aja Pay Method</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="text-center mb-3">
                <img src="img/linkaja.jpeg" width="200px" height="200px">
            </div>
            <div>
                <ol>
                    <li>Buka aplikasi Link Aja di handphone mu</li>
                    <li>Klik menu bayar yang ada di bagian bawah layar handphone</li>
                    <li>Jendela scan akan terbuka, lalu arahkan pada Barcode</li>
                    <li>Masukkan nominal bayar sebesar yang tertera pada halaman checkout</li>
                    <li>Jika sudah bayar, klik tombol bayar pada halaman Barcode</li>
                </ol>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="functions/bayar.php" class="btn text-white" style="background-color: #fe0018;">Bayar</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="bni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #e85d26;">
            <h5 class="modal-title text-white" id="exampleModalLabel">BNI Mobile Pay Method</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="text-center mb-3">
                <img src="img/bni.jpeg" width="200px" height="200px">
            </div>
            <div>
                <ol>
                    <li>Buka aplikasi BNI Mobile handphone mu</li>
                    <li>Klik menu QRIS yang ada di bagian bawah layar handphone</li>
                    <li>Jendela scan akan terbuka, lalu arahkan pada Barcode</li>
                    <li>Masukkan nominal bayar sebesar yang tertera pada halaman checkout</li>
                    <li>Jika sudah bayar, klik tombol bayar pada halaman Barcode</li>
                </ol>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="functions/bayar.php" class="btn text-white" style="background-color: #e85d26;">Bayar</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="bsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #1da29d;">
            <h5 class="modal-title text-white" id="exampleModalLabel">BSI Mobile Pay Method</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="text-center mb-3">
                <img src="img/bsi.jpeg" width="200px" height="200px">
            </div>
            <div>
                <ol>
                    <li>Buka aplikasi BSI Mobile handphone mu</li>
                    <li>Klik menu QRIS yang ada di bagian bawah layar handphone</li>
                    <li>Jendela scan akan terbuka, lalu arahkan pada Barcode</li>
                    <li>Masukkan nominal bayar sebesar yang tertera pada halaman checkout</li>
                    <li>Jika sudah bayar, klik tombol bayar pada halaman Barcode</li>
                </ol>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="functions/bayar.php" class="btn text-white" style="background-color: #1da29d;">Bayar</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="gopay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #00aa13;">
            <h5 class="modal-title text-white" id="exampleModalLabel">Gopay Pay Method</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="text-center mb-3">
                <img src="img/gopay.jpeg" width="200px" height="200px">
            </div>
            <div>
                <ol>
                    <li>Buka Gojek di handphone mu</li>
                    <li>Klik menu bayar yang ada di bagian atas (menu gopay) layar handphone</li>
                    <li>Jendela scan akan terbuka, lalu arahkan pada Barcode</li>
                    <li>Masukkan nominal bayar sebesar yang tertera pada halaman checkout</li>
                    <li>Jika sudah bayar, klik tombol bayar pada halaman Barcode</li>
                </ol>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="functions/bayar.php" class="btn text-white" style="background-color: #00aa13;">Bayar</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h5 class="modal-title" id="exampleModalLabel">Bill</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php
                if($status == 'bayar')
                {
                    echo "<div>
                        <h3>Tunggu Konfirmasi Admin...</h3>
                    </div>";
                }
                else if($status == 'konfirmasi')
                {
                    $query = "SELECT p.foto, p.id, c.id_customers, c.id_produk, p.nama, c.harga_produk, c.banyak_produk, c.total FROM produk p INNER JOIN orders c ON p.id=c.id_produk WHERE c.id_customers=$id_cus";
                    $result = mysqli_query($conn, $query);
                    $datas = [];
                    while ($data = mysqli_fetch_assoc($result)) {
                        $datas[] = $data;
                    }
                    echo "<div class='text-center mb-3'><h4>PETTO</h4></div>";
                    foreach ($datas as $d) : ?>
                    <div class='row'>
                        <div class="col-md-6">
                            <p><?= $d['nama'] ?></p>
                        </div>
                        <div class="col-md-3">
                            <p><?= $d['banyak_produk'] ?> x <?= $d['harga_produk'] ?></p>
                        </div>
                        <div class="col-md-3">
                            <p>Rp.<?= $d['total'] ?></p>
                        </div>
                    </div>
                    <?php endforeach;
                    $query2 = "SELECT total FROM customers WHERE id=$id_cus";
                    $result = mysqli_query($conn, $query2);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    echo "<hr>
                        <div class='row'>
                            <div class='col-md-6'>
                                <p>Total</p>
                            </div>
                            <div class='col-md-3'>
                                <p></p>
                            </div>
                            <div class='col-md-3'>
                                <p>Rp. {$row['total']}</p>
                            </div>   
                        </div><hr>";
                    
                    $query2 = "SELECT p.foto, p.id, c.id_customers, c.id_produk, p.nama, c.harga_produk, c.banyak_produk, c.total FROM produk p INNER JOIN orders c ON p.id=c.id_produk WHERE c.id_customers=$id_cus";
                    $result = mysqli_query($conn, $query2);
                    $datas = [];
                    while ($data = mysqli_fetch_assoc($result)) {
                        $datas[] = $data;
                    }
                    include "phpqrcode/qrlib.php";

                    $path="qrimages/";
                    $file = $path.uniqid().".png";

                    $text = '';

                    foreach($datas as $d) : ?>
                    <?php
                        $text .= $d['nama'] . " ";
                        $text .= $d['banyak_produk'] . " x " . $d['harga_produk']. "\n";
                    endforeach;

                    $text .= "Total ";
                    $text .= $row['total'] . " ";

                    QRcode::png($text, $file, 'L', 5, 2);
                    echo"<center><img src='".$file."'></center>";
                    echo"<p class='text-center mt-3'>Scan barcode di atas saat pengambilan barang</p>";
                }
            ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>