<?php
    include_once "assets/php/readDB.php";
    include_once "assets/php/logout.php";

    session_start();
    $logout = new logout();
    $readDB = new readDB();

    if(empty($_POST['loadMapel1'])){

    }

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
<head>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
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

    function mapelUpdate(){
      $.ajax({
        type: "POST",
        url: 'assets/php/list_mapel.php',
        data:{loadMapel1:'loadMapel1', classes:document.getElementById('inputState').value},
        success: function(response){  
          $('#content').html(response);
        }
      });
    }
 </script>
<!-- End Head -->

<body>

<script>
  $(document).ready(function(){
      $.ajax({
        type: "POST",
        url: 'assets/php/list_mapel.php',
        data:{loadMapel1:'loadMapel1', classes:"All"},
        success: function(response){  
          $('#content').html(response);
        }
      });
    });
</script>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php">PINTARIN</a></h1>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li class="active"><a href="classes.php">Classes</a></li>
          <li><a href="submission.php">Submission</a></li>
          <li><a href="subs.php">Subscribe</a></li>
        </ul>
      </nav><!-- .nav-menu -->

      <?php include_once ('namauserdipojokan.php');?>

    </div>
  </header><!-- End Header -->

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>Classes</h2>
        Each class contains video lectures, tasks, and text materials. All classes viewed by you are displayed in your personal account.
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">
        <div class="row" data-aos="zoom-in" data-aos-delay="100">

        <div class="container position-relative">
            <div class="form-group col-md-4 rounded float-right">
                <label for="inputState">Class</label>
                <select id="inputState" name="inputState" onchange="mapelUpdate()" class="form-control">
                    <option>All</option>
                    <option>SD</option>
                    <option>SMP</option>
                    <option>SMA</option>
                </select>
            </div>
        </div>

        <!-- <div id="content"></div> -->
        <div class='col-md-12 d-md-flex' id="content"></div>
      </div>
    </section><!-- End Courses Section -->

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

  <!-- Font -->
  <script src="https://kit.fontawesome.com/f70f44ba6a.js" crossorigin="anonymous"></script>

</body>

</html>