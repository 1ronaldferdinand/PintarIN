<?php
    include_once "assets/php/login.php";

    if(isset($_POST['submit'])){
        $login = new login();
        
        if($login->loginUser()){
            header("location:classes.php");
        }else{
            echo "<script>alert('Email atau Password Salah');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once ('head.php'); ?>
    </head>

    <body class="home">
        <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="home.php">PINTARIN</a></h1>

        <a href="registrasi.php" class="get-started-btn">Get Started</a>

        </div>
        </header><!-- End Header -->


        <main id="main">

        <section id="contact" class="contact">
        

        <div class="container" data-aos="fade-up">

            <div class="frame php-email-form">

                <form action="" method="post" role="form">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="username" placeholder="Email" data-rule="minlen:8" data-msg="Please enter a valid username" />
                    <div class="validate"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" data-rule="minlen:8" data-msg="Please enter a valid password" />
                    <div class="validate"></div>
                </div>
                <div class="">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit" name="submit">Login</button></div>
                </form>
                <div class="text-center"><button type="flat" onclick="document.location='registrasi.php'">Registrasi</button></div>
            </div>

        </div>
        </section><!-- End Contact Section -->

    </main>

    <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counterup/counterup.min.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    </body>
</html>