<?php
    include_once "../assets/php/readDB.php";

    $readDB = new readDB();

    if(isset($_POST['loadMapel'])){
      $class = $readDB->getMapel($_POST['classes'], $_POST['degree']);
      // var_dump($class);
      foreach($class as $i){
        $classPos = $i['nama_mapel'];
        echo "
          <option value='$classPos'>$classPos</option>
        ";
      }
    }
    
?>