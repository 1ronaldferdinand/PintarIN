<?php
    session_start();
    include_once "assets/php/readDB.php";
    include_once "assets/php/logout.php";

    $logout = new logout();
    $readDB = new readDB();

    if(empty($_SESSION['id_user'])){
        header("location:index.php");
    }

    $readSubmmission = $readDB->readAllSubmission();
    $submisson = $readSubmmission->fetchAll();

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
            <li class="active"><a href="submission.php">Submission</a></li>
            <li><a href="subs.php">Subscribe</a></li>
            </ul>
        </nav>
        <!-- End nav-menu -->

        <?php include_once ('namauserdipojokan.php');?>
        
        </div>
    </header>
    <!-- End Header -->
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" style="text-align: center;">
        <div class="container-fluid">
            <h1>Your All Submission</h1>
        </div>
    </div><!-- End Breadcrumbs -->

  <!-- ======= Hero Section ======= -->
  <section id="" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative"  ><br><br>
        <div class="row" >
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="table-primary">
                <th scope="col">Judul</th>
                <th scope="col">Kelas</th>
                <th scope="col">Nilai</th>
                <th scope="col">Tanggal</th>
                </tr>
            </thead>
            <tbody>
            <?php
                for ($i = 0; $i < count($submisson); $i++) {
                    ?>
                <tr>
                <td><?=$submisson[$i]['judul']?></td>
                <td><?=$submisson[$i]['kelas']?></td>
                <td><?=$submisson[$i]['nilai']?></td>
                <td><?=$submisson[$i]['tanggal']?></td>
                </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>


  </section><!-- End Hero -->

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