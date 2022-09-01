<?php 
  if(isset($_POST['logout'])){
    $logout->logoutUser();

    header("location:index.php");
  }
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

<a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
  <div class="media align-items-center">
      <div class="media-body  ml-2  d-none d-lg-block">
        <span class="get-started-btn mb-0 text-sm font-weight-bold"><?=$_SESSION['user_name']?></span>
      </div>
  </div>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li><a class="dropdown-item" href="" onclick="logout()">Log Out</a></li>
  </ul>
</a>