<?php
  include_once "../assets/php/createDB.php";
  include_once "../assets/php/readDB.php";
  include_once "../assets/php/updateDB.php";
  include_once "../assets/php/logout.php";

  session_start();
  $logout = new logout();
  $createDB = new createDB("");
  $updateDB = new updateDB();

  if(empty($_SESSION['id_admin'])){
    header("location:index.php");
  }

  if(isset($_POST['logout'])){
      $logout->logoutUser();

      header("location:index.php");
  }

  if(isset($_POST['submit'])){
    if($_GET['id_materi'] == "0"){
      $createLesson = $createDB->createMateri();
    }else{
      $updateDB->updateMateri();
      header('location:lesson.php');
    }
    // var_dump($_GET['id_materi']);
  }

  $status = '';

  // var_dump($_GET['id_materi']);

  if($_GET['action'] == "updateLesson" ){
    $readDB = new readDB();
    $getMateri = $readDB->getValueFrom("materi", "id_materi", $_GET['id_materi']);
    $materi = $getMateri->fetchAll();
    
    $getMapel = $readDB->getValueFrom("mapel", "id_mapel", $materi[0]['id_mapel']);
    $mapel = $getMapel->fetchAll();
    $id_mapel = $mapel[0]['id_mapel'];
    // var_dump($id_mapel);

    $title = $materi[0]['nama_materi'];
    $video = $materi[0]['video'];
    $content = $materi[0]['isi'];
    
    if($materi[0]['status'] == 'langganan'){
      $status = "checked";
    }else{
      $status = '';
    }
  }else{
    $title = '';
    $video = '';
    $content = '';
  }
?>
<!--
=========================================================
* Material Dashboard Dark Edition - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard-dark
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Lesson Management
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!-- ckeditor 4 -->
  <script src="assets/ckeditor/ckeditor.js"></script>
	<script src="assets\ckeditor\samples\js\sample.js"></script>
</head>

<body class="dark-edition">
  <div class="wrapper ">
  <div class="sidebar" data-color="purple" data-background-color="black" data-image="assets/img/sidebar-2.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
        PintarIN Admin
        </a></div>
      <div class="sidebar-wrapper" style="position: relative;">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="lesson.php">
            <i class="material-icons">content_paste</i>
              <p>Lesson</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="quiz.php">
            <i class="material-icons">library_books</i>
              <p>Quiz</p>
            </a>
          </li>
          <li class="nav-item" style="position: absolute; bottom: 0em;">
            <a class="nav-link" style="float:left;">
              <i class="material-icons">person</i>
              <p><?=$_SESSION['user_name_admin']?></p>
            </a>
            <a href="lesson.php" onclick="logout()" style="float: right; margin-left:50px; margin-top:12px; background:red; color:white; font-weight: bold;">Log Out</a>
          </li>
        </ul>
        <div >
        </div>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Lesson Management</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <!-- Login -->
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Add Lesson</h4>
                  <p class="card-category"> Here is for adding Lesson</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form action="" method="post">
                      <input type="hidden" name="id_mapel" id="" value="<?=$id_mapel?>">
                      <input type="hidden" name="update" id="update" value="<?=$_GET['action']?>">
                      <label for="title">Title:</label><br>
                      <input type="text" value="<?=$title?>" name="title" id="" style="width:40%;"><br><br>
                      <label for="videoUrl">Video Url:</label><br>
                      <input type="text" value="<?=$video?>" name="video_url" id="" style="width:40%;"><br><br>
                      <label for="question">Subject Matter:</label><br>
                      <textarea id="editor" name="content"><?=$content?></textarea><br>
                        <div class="col-md-4">
                          <?php
                            if($_GET['action'] == "insertLesson"){
                          ?>
                          <input type="hidden" name="" id="degreeValue">
                          <input type="hidden" name="" id="classValue">
                          <input type="hidden" name="" id="degrees" value=>
                          <label for="">Pilih Tingkatan Sekolah:</label>
                          <select name="degree" id="degree" onchange="classUpdate()" class="form-control" style="background-color: white; color: black;">
                            <option>--Pilih Tingkatan--</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                          </select><br>
                          <label for="">Pilih Kelas:</label>
                          <select name="classes" onchange="lessonUpdate()" id="classes" class="form-control" style="background-color: white; color: black;">
                          </select><br>
                          <label for="">Pilih Mata Pelajaran:</label>
                          <select name="lesson" id="lesson" class="form-control" style="background-color: white; color: black;">
                          </select><br>
                            <?php } ?>
                          <input type="checkbox" <?=$status?> name="status" id="">
                          <label for="">Langganan</label><br><br>
                        </div>
                      <input type="submit" value="Kirim" name="submit">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        function classUpdate(){
          var degree = document.getElementById('degree').value;
          if(degree == "SD"){
            document.getElementById('degreeValue').value = 6;
          }else{
            document.getElementById('degreeValue').value = 3;
          }

          var index1 = document.getElementById("degreeValue").value;
          var classes = document.getElementById("classes");
        if(index1 == ""){
            index1 = 6;
        }

          document.querySelector('#classes').innerHTML = '';

          for(i = 0; i <= index1; i++){
            var option = document.createElement("option");
            if(i == 0){
              option.text = "--Pilih Kelas--";
              option.value = "--Pilih Kelas--";
            }else{
              option.text = i;
              option.value = i;
            }
            try {
              classes.add(option, null); //Standard 
            }catch(error) {
              classes.add(option); // IE only
            }
          }
        }

        function lessonUpdate(){
          var classes = document.getElementById('classes').value;
          document.getElementById('classValue').value = classes;

          $.ajax({
            type: "POST",
            url: 'create_option_mapel.php',
            data:{loadMapel:'loadMapel', classes:document.getElementById('classes').value, degree:document.getElementById("degree").value},
            success: function(response){  
              $('#lesson').html(response);
            }
          });
        }

        function logout() {
          $.ajax({
              type: "POST",
              url: '',
              data:{action:'logout', logout:true},
              success: function(){
                window.location.assign('index.php');
            }
          });
        }

        function updateData(val){

        }

        // ckeditor call
        initSample();
      </script>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
</body>

</html>