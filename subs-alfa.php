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
            <div class="container position-relative" data-aos="fade-up"><br>
                <div class="alert alert-danger text-center" role="alert">
                Silahkan bayar sebelum 
                    <div id="demo"></div>
                    <script>
                    // Set the date we're counting down to
                    var today = new Date();
                    var countDownDate = today.setTime(today.getTime() + (1*60*60*1000))

                    // Update the count down every 1 second
                    var x = setInterval(function() {

                    // Get today's date and time
                    var now = new Date().getTime();
                        
                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;
                        
                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        
                    // Output the result in an element with id="demo"
                    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";
                        
                    // If the count down is over, write some text 
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                    }
                    }, 1000);
                    </script>
                </div>
                
                <div class="card">
                        <div class="row">
                            <div class="col-lg-6 order-1 order-lg-4" data-aos="fade-left" data-aos-delay="100">
                            <div class="container-fluid"><br><br>
                                <img src="assets/img/alfa.png" class="rounded float-center ml-5 mt-3" width="420px" alt="" >
                            </div>
                            </div>

                        
                            <div class="order-lg-4 content" data-aos="fade-right">
                                <div><br><br>
                                    <h4>Kode Pembayaraan</h4>
                                        <h3>
                                            <small class="text-muted">ASJ47DHFRY7</small>
                                        </h3><br>
                                    <h4>Nominal yang akan dibayarkan</h4>
                                        <h4>
                                            <h3>
                                                <small class="text-muted">Rp 100.000</small>
                                            </h3><br>
                                        </h4>
                                    <a href="subs-konfir.php" class="btn btn-secondary btn-lg active" style="background-color: #145DA0" role="button" aria-pressed="true">Konfirmasi Pembayaran</a><br><br>
                                </div>
                            </div>
                        </div>
                </div><br><br>

                <div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active text-secondary" id="indo-tab" data-toggle="tab" href="#indo" role="tab" aria-controls="indo" aria-selected="true">Alfamart</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="indo" role="tabpanel" aria-labelledby="indo-tab"><br>
                            <h5>LANGKAH 1: PERGI KE ALFAMART TERDEKAT</h5><br>
                            <h4>
                            <small class="text-muted">
                                1. Sampaikan kepada kasir Alfamart untuk melakukan pembayaraan PintarIN <br><br>
                                2. Tunjukan kode pembayaran ke kasir dan lakukan pembayaraan sebesar Rp 100.00 <br>
                            </small>
                            </h4><br>
                            <h5>LANGKAH 2: TRANSAKSI BERHASIL</h5><br>
                            <h4>
                            <small class="text-muted">
                                1. Setelah transaksi berhasil, kamu akan mendapatkan bukti pembayaran. Mohon simpan bukti tersebut sebagai jaminan <br> apabila diperlukan verifikasi lebih lanjut <br><br>
                                2. Setelah transaksi selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin akan membutuhkan waktu beberapa menit
                            </small>
                            </h4>
                        </div>
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