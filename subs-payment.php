<?php
    include_once "assets/php/readDB.php";
    include_once "assets/php/logout.php";

    session_start();
    $logout = new logout();
    $readDB = new readDB();

    if(empty($_SESSION['id_user'])){
        header("location:index.php");
    }

    if(isset($_POST['logout'])){
        $logout->logoutUser();

        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<!-- ======= Head ======= -->
  <?php require_once ('head.php'); ?>
  <script>
    function logout() {
        $.ajax({
            type: "POST",
            url: '',
            data:{action:'logout', logout:true},
            success: function(){
                window.location.assign("index.php");
            }
        });
    }
 </script>
<!-- End Head -->

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="home.php">PINTARIN</a></h1>
        <!-- .nav-menu -->
        <nav class="nav-menu d-none d-lg-block">
            <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="classes.php">Classes</a></li>
            <li><a href="submission.php">Submission</a></li>
            <li class="active"><a href="subs.php">Subscribe</a></li>
            </ul>
        </nav>
        <!-- End nav-menu -->

        <?php include_once ('namauserdipojokan.php');?>

        </div>
    </header>
    <!-- End Header -->

    <!-- Payment section -->
    <section id="payment" class="d-flex justify-content-center align-items-center">
        <div class="container position-relative">
            <div class="row mb-5 pt-5">
                <div class="col text-center">
                    <h2>SILAHKAN PILIH METODE PEMBAYARAN</h2>
                    <h4>PEMBAYARAN SEBESAR IDR 100.000</h4>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    Metode Pembayaran
                </div>
                <div class="card-body">
                    <div class="card-deck align-items-center">
                        <div class="card mb-2">
                            <a href="subs-indo.php"><img src="assets/img/indo.png" class="card-img-top" alt="indomaret"></a>
                        </div>
                        <div class="card mb-2">
                            <a href="subs-alfa.php"><img src="assets/img/alfa.png" class="card-img-top" alt="alfamart"></a>
                        </div>
                        <div class="card mb-2">
                            <a href="subs-bri.php"><img src="assets/img/brii.png" class="card-img-top" alt="bri"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br><br><br><br><br><br><br>
    <!-- End Payment section -->


    <!-- ======= Footer ======= -->
    <?php include_once('footer.php'); ?>
    <!-- End Footer -->

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