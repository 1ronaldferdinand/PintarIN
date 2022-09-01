<?php 
    include_once 'assets/php/createDB.php'; 
    include_once 'assets/php/login.php';

    if(isset($_POST['submit'])){
        $createDB = new createDB("");
        if ($createDB->createUser()) {
            $login = new login();
            
            if ($login->loginUser()) {
                header("location:classes.php");
            } else {
                echo "<script>alert('Email atau Password Salah');</script>";
            }
        }
        }else{
            echo "Email is Already Use";
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            require_once ('head.php');
        ?>
    </head>

    <body class="home">
        <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="index.php">PINTARIN</a></h1>

        <a href="registrasi.php" class="get-started-btn">Get Started</a>

        </div>
        </header><!-- End Header -->


        <main id="main">

        <section id="contact" class="contact">
        

        <div class="container" data-aos="fade-up">

            <div class="frame php-email-form">
                    <form action="" method="POST">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                        <input type="text" name="user_name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                        <div class="validate"></div>
                        </div>
                        <div class="col-md-6 form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                        <div class="validate"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" data-rule="minlen:8" data-msg="Please enter at least 8 chars" />
                        <div class="validate"></div>
                        </div>
                        <div class="col-md-6 form-group">
                        <input type="password" class="form-control" name="konfirm-password" id="konfirm-password" placeholder="Konfirm Password" data-rule="minlen:8" data-msg="Please enter at least 8 chars" />
                        <div class="validate"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-md form-group" for="phone">Phone Number</label>
                        <div class="col-md-10 form-group">
                        <input type="" name="no_telp" class="form-control" id="phone" placeholder="+6288888888888" data-rule="" data-msg="Please enter a valid phone number" />
                        <div class="validate"></div>
                        </div>                    
                    </div>
                    <div class="form-row">
                        <label class="col-md form-group" for="birthday">Birthday</label>
                        <div class="col-md-10 form-group">
                        <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Tanggal Lahir" data-rule="" data-msg="Please enter a valid date" />
                        <div class="validate"></div>
                        </div>
                    </div>
                    <div class="">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div class="text-center"><button type="submit" name="submit">Register</button></div>
                    
                    </form>
                    <div class="text-center"><button type="flat" onclick="document.location='login.php'">Login</button></div>
                
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