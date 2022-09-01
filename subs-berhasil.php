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
  <?php require_once ('head.php'); 
  include_once "assets/php/createDB.php";

  session_start();
  $createDB = new createDB("");

  $createDB->createTransaction();
  ?>
  
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
            <div class="container position-relative" data-aos="fade-down"><br>
                <div class="alert alert-success text-center" role="alert">
                    Berhasil Berlangganan !!!
                </div><br><br>
                
                <div>
                    <div class="text-center" data-aos="fade-down" data-aos-delay="100">
                        <div class="container-fluid">
                            <img src="assets/img/suc.png" class="img-fluid" width="200px" alt="Responsive image" >
                        </div><br>

                        <div>
                            <h1 class="display-4"><b>Selamat kamu telah berhasil Berlangganan</b></h1>
                            <h3>
                                <small class="text-muted">Pembayaranmu sudah berhasil. Silahkan nikmati fitur bebas akses yang tersedia :)</small>
                            </h3>
                        </div>
                        
                    </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                        <a href="home.php" class="btn btn-secondary btn-lg active mt-3" style="background-color: #145DA0" role="button" aria-pressed="true">
                        Klik Disini untuk kembali ke Halaman Home</a><br><br><br><br><br>
                    </div>
                </div>
                


            </div>
    </section>
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