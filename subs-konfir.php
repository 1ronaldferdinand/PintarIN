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
    <section id="payment" class="d-flex justify-content-center align-items-center mt-5">
            <div class="container position-relative mt-5" data-aos="fade-down"><br>
                

                <div class="card position-relative mt-5">
                    <div class="card-body">
                    <div class="text-center" data-aos="fade-down" data-aos-delay="100">
                            <div class="container-fluid mt-5">
                                <h1 class="display-4"><b>Konfirmasi Pembayaran</b></h1>
                                <h3>
                                    <small class="text-muted">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="indomaret" name="customRadioInline1" class="custom-control-input">
                                            <label class="custom-control-label" for="indomaret">Indomaret</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="alfamart" name="customRadioInline1" class="custom-control-input">
                                            <label class="custom-control-label" for="alfamart">Alfamart</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="bri" name="customRadioInline1" class="custom-control-input">
                                            <label class="custom-control-label" for="bri">Bank BRI</label>
                                        </div>
                                    </small>
                                </h3>
                                <div class="custom-file col-md-5 rounded float-center mt-2">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="100">
                            <a href="subs-payment.php"><input class="btn btn-light" type="reset" value="Cancel"></a>
                            <a href="subs-berhasil.php"><input class="btn btn-primary ml-2" style="background-color: #145DA0" type="submit" value="Save"></a>
                        </div><br><br>
                    </div>
                    </div>
                <div><br><br><br>
                    
                


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