<?php
    include_once "assets/php/readDB.php";
    include_once "assets/php/createDB.php";
    include_once "assets/php/logout.php";
    include_once "assets/php/deleteDB.php";

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

    $logout = new logout();
    $readDB = new readDB();

    $index = isset($_POST['index']) ? $_POST['index'] : 0;

    $readQuestion = $readDB->readQuizQuestion();
    $question = $readQuestion->fetchAll();
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
            <li class="active"><a href="classes.php">Classes</a></li>
            <li><a href="submission.php">Submission</a></li>
            <li><a href="subs.php">Subscribe</a></li>
            </ul>
        </nav>

        <?php include_once ('namauserdipojokan.php');?>

        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" style="text-align: left;">
        <div class="container">
            <h1>KUIS</h1>
        </div>
    </div><!-- End Breadcrumbs -->

  <!-- ======= Hero Section ======= -->
  
  <section id="" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative">
    <?php
        $id_mapel = $_GET['id_mapel'];
        if(isset($_POST['submit'])){
            $index += 1;
            $createDB = new createDB("");
            $createDB->createUserAnswer();
        }

        if(isset($_POST['kembali'])){
            header("location:materi.php?id_mapel=$id_mapel");
        }

        if($index < count($question)-1){
            $nameSubmit = "Selanjutnya";
        }else{
            $nameSubmit = "Kirim";
        }
        
        if($index <= count($question)-1){
    ?>
        <h4><?=$question[$index]['soal']?></h4>
        <br>
        <div>
            <form action="" method="post">
                <input type="hidden" name="index" value=<?=$index?>>
                <input type="radio" id="a" name="answer" value="a">
                <label for="a"><?=$question[$index]['jawaban_a']?></label><br>
                <input type="radio" id="b" name="answer" value="b">
                <label for="b"><?=$question[$index]['jawaban_b']?></label><br>
                <input type="radio" id="c" name="answer" value="c">
                <label for="c"><?=$question[$index]['jawaban_c']?></label><br>
                <input type="radio" id="d" name="answer" value="d">
                <label for="d"><?=$question[$index]['jawaban_d']?></label><br>
                <input type="radio" id="e" name="answer" value="e">
                <label for="e"><?=$question[$index]['jawaban_e']?></label><br>
                <input  class="btn btn-primary" type="submit" value="<?=$nameSubmit?>" name="submit">
            </form>
        </div>

    <?php
        }else{
    ?>
        <h4>Selamat anda telah menyelesaikan kuis</h4><br>
        <h4>Nilai Anda</h4><br>
        <h3><?=$readDB->getScore($readDB->checkAnswer())?></h3>
        <form action="" method="post">
            <input type="submit" value="Kembali" name="kembali">
        </form>
    <?php
            $createDB->createSubmission($readDB->getScore($readDB->checkAnswer()));

            $deleteDB = new deleteDB();

            $delUserAns = $deleteDB->deleteUserAnswer();
        }
    ?>
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