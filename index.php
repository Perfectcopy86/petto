<?php
    include("function.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PETTO</title>
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
    <style type="text/css">
        .carousel-caption {
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background: rgba(0, 0, 0, 0.3);
          z-index: 1;
        }
    </style>
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
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-warning font-weight-bold border px-3 mr-1"><i class="fa-solid fa-paw"></i></span>PETTO</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left"> 
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="cart.php" class="btn border">
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
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-warning text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
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
                    <a href="index.php" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-warning font-weight-bold border px-3 mr-1"><i class="fa-solid fa-paw"></i></span>PETTO</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
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
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="https://media.istockphoto.com/photos/funny-friends-cute-cat-and-corgi-dog-are-lying-on-a-white-bed-picture-id1347494018?k=20&m=1347494018&s=612x612&w=0&h=ztjdI3c9A9DUAxZ7b_qgkPF7HN6FxKifCrUuQF7zz3M=" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Healthy Foods</h3>
                                    <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="https://images.unsplash.com/photo-1450778869180-41d0601e046e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTl8fHBldHxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                    <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-warning m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-warning m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Good Service</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-warning m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">
                        <?php 
                            $data=readQueryId(1);
                            echo $data['banyak'];
                        ?>
                        Products
                    </p>
                    <a href="shop-foods.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid w-100" src="img/kering1.png" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Food</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">
                    <?php 
                            $data=readQueryId(2);
                            echo $data['banyak'];
                        ?>
                        Products
                    </p>
                    <a href="shop-toys.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/toys.png" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Toys</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">
                        <?php 
                            $data=readQueryId(3);
                            echo $data['banyak'];
                        ?>
                        Products
                    </p>
                    <a href="shop-clothes.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/clothes.png" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Clothes</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">
                        <?php 
                            $data=readQueryId(4);
                            echo $data['banyak'];
                        ?>
                        Products
                    </p>
                    <a href="shop-accessories.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/acs.png" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Accessories</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right"><?php 
                            $data=readQueryId(6);
                            echo $data['banyak'];
                        ?>
                        Products</p>
                    <a href="shop-sleeps.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/sleep.png" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Sleeping Tools</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">
                        <?php 
                            $data=readQueryId(7);
                            echo $data['banyak'];
                        ?>
                        Products
                    </p>
                    <a href="shop-grooms.php" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/groom.png" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Grooming Tools</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories End -->

    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="img/logo whiskas.png" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/pedegree.png" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/satwa.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/west.png" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/royal.png" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/outward.png" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/purina.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


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