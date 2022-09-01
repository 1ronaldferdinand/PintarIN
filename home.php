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
            data:{action:'logout', logout:true}
        });
    }
 </script>
<!-- End Head -->

<body>
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="home.php">PINTARIN</a></h1>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="home.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="classes.php">Classes</a></li>
          <li><a href="submission.php">Submission</a></li>
          <li><a href="subs.php">Subscribe</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <?php include_once ('namauserdipojokan.php');?>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>Online education for your,<br>children</h1>
      <h2>We are help for education in the world. We make world a better place.</h2>
      <a href="classes.php" class="btn-get-started">Choose Class</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <p>About Us</p>
        </div>

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>PINTARIN adalah jawaban untuk semua permasalahan pembelajaran daring</h3>
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
              PINTARIN dirancang oleh kami setelah ditemukannya banyak permasalahan pada masa pembelajaran daring yang terjadi di sekolah-sekolah.
            </p>
            <a href="about.php" class="learn-more-btn">Learn More</a>
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