<?php
    include("function.php");
    if(isset($_POST['signup'])){
        if(signup_cus($_POST) > 0){
            echo"
                <script>
                    alert('Create Account Successfully!');
                    document.location.href = 'signin_cus.php';
                </script>";
        }
        else{
            echo"
                <script>
                    alert('Cannot Create Account!');
                    document.location.href = 'signup_cus.php';
                </script>"; 
        }
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <script src="https://kit.fontawesome.com/2e689b6a31.js" crossorigin="anonymous"></script>

    <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="css/style_sign.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <div class="text-warning">
                            <?php 
                                if (isset($_COOKIE["message"])) {
                                    echo $_COOKIE["message"];
                                }
                            ?>
                        </div>
                        <form method="POST" class="register-form" id="register-form" action="">
                            <div class="form-group">
                                <label for="name"><i class="fa-solid fa-user"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="alamat"><i class="fa-solid fa-location-dot"></i></label>
                                <input type="text" name="alamat" id="alamat" placeholder="Your Address" required/>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="fa-solid fa-phone"></i></label>
                                <input type="text" name="phone" id="phone" placeholder="Your Phone" required/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fa-solid fa-envelope"></i></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="username"><i class="fa-solid fa-at"></i></label>
                                <input type="text" name="username" id="username" placeholder="Your Username" required/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="fa-solid fa-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="re_password"><i class="fa-solid fa-unlock"></i></label>
                                <input type="password" name="re_password" id="re_password" placeholder="Repeat your password" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="img/garfield.png" alt="sing up image"></figure>
                        <a href="signin_cus.php" class="signup-image-link">I am already have an account</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>