<?php
    include_once "assets/php/readDB.php";
    include_once "assets/php/logout.php";

    session_start();
    $logout = new logout();
    $readDB = new readDB();

    $readDB->readExpiredTransaction();

    if(empty($_SESSION['id_user'])){
        header("location:index.php");
    }

    $readMapel = $readDB->readMapel();
    $mapel = $readMapel->fetchAll();

    $readMateri = $readDB->readMateri();
    $materi = $readMateri->fetchAll();

    $class = $readDB->getSingleValueFrom('mapel', 'id_mapel', $_GET['id_mapel'], 'kelas');
    $classKategory = $readDB->getSingleValueFrom('mapel', 'id_mapel', $_GET['id_mapel'], 'kategori');

    $readQuizName = $readDB->readQuizName();
    $quizName = $readQuizName->fetchAll();

    if(isset($_POST['logout'])){
        $logout->logoutUser();

        header("location:index.php");
    }
   
?>

<!DOCTYPE html>
<html lang="en">

<!-- ======= Head ======= -->
  <?php require_once('head.php'); ?>
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
            <li class="active"><a href="classes.php">Classes</a></li>
            <li><a href="submission.php">Submission</a></li>
            <li><a href="subs.php">Subscribe</a></li>
            </ul>
        </nav>
        <!-- End nav-menu -->

        <?php include_once ('namauserdipojokan.php');?>
        
        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" style="text-align: left;">
        <div class="container">
            <h1><?=$readDB->getSingleValueFrom('mapel', 'id_mapel', $_GET['id_mapel'], 'nama_mapel')?></h1>
            <h3>Kelas <?=$class?> <?=$classKategory?> </h3>
        </div>
    </div><!-- End Breadcrumbs -->

  <!-- ======= Hero Section ======= -->
  <section id="" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative"  ><br><br>
        <div class="list-group">
            <h4>Materi</h4><br>
            <?php
                for($i = 0; $i < count($materi); $i++){
            ?>
                <a href="materi-detail.php?id_mapel=<?=$_GET['id_mapel']?>&id_materi=<?=$materi[$i]['id_materi']?>" class="list-group-item list-group-item-action">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                        <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                    </svg>
                    <?=$readDB->getSingleValueFrom('admin', 'id_admin', $materi[$i]['id_admin'], 'nama')?> memposting materi baru : <?=$materi[$i]['nama_materi']?>
                </a><br>
            <?php }?>
        </div><br><br>

        <div class="list-group">
            <h4>Kuis</h4><br>
            <?php
                for($i = 0; $i < count($quizName); $i++){
            ?>
                <a href="kuis.php?id_mapel=<?=$_GET['id_mapel']?>&id_kuis=<?=$quizName[$i]['id_judul_kuis']?> &nama_kuis=<?=$quizName[$i]['judul']?>" class="list-group-item list-group-item-action">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                        <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                    </svg>
                    <?=$readDB->getSingleValueFrom('admin', 'id_admin', $quizName[$i]['id_admin'], 'nama')?> memposting kuis baru : <?=$quizName[$i]['judul']?>
                </a><br>
            <?php }?>
        </div>

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