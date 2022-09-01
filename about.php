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

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php">PINTARIN</a></h1>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="home.php">Home</a></li>
          <li class="active"><a href="about.php">About</a></li>
          <li><a href="classes.php">Classes</a></li>
          <li><a href="submission.php">Submission</a></li>
          <li><a href="subs.php">Subscribe</a></li>
        </ul>
      </nav>

      <?php include_once ('namauserdipojokan.php');?>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>About Us</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>PINTARIN adalah jawaban untuk semua permasalahan pembelajaran daring<br></h3>
            <p class="font-italic">
              Informatika 02-2018 :
            </p>
            <ul>
              <li><i class="icofont-check-circled"></i> 18.11.1895 | Fajar Muhammad Sidiq</li>
              <li><i class="icofont-check-circled"></i> 18.11.1896 | Kurniawan Dwi Waestaputra</li>
              <li><i class="icofont-check-circled"></i> 18.11.1904 | Ronald Ferdinand</li>
              <li><i class="icofont-check-circled"></i> 18.11.1913 | Aprilia Nurkasanah</li>
              
              
              </ul>
            <p>
            <b>PINTARIN</b> dirancang oleh kami setelah ditemukannya banyak permasalahan pada masa pembelajaran daring yang terjadi di sekolah-sekolah. 
            <b>Setelah melalui satu tahun pandemi, kami menemukan banyak sekolah sekolah yang proses pembelajarannya secara teknis terhambat</b>. 
            Banyak hal yang menjadi faktor, salah satunya media pembelajaran yang tidak jelas. 
            Oleh karena itu, kami berinisiatif untuk membuat sebuah media pembelajaran universal berbasis website, yang dapat digunakan oleh seluruh sekolah di <b>INDONESIA<b>.
            </p>

            <p>
            <br><br>
            <h3>Visit Us at</h3>
            <br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15812.966763759052!2d110.42729515185547!3d-7.764173878237303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a599bd3bdc4ef%3A0x6f1714b0c4544586!2sUniversitas%20Amikom%20Yogyakarta!5e0!3m2!1sid!2sid!4v1610033370512!5m2!1sid!2sid" width="1120" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </p>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

  </main><!-- End #main -->

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