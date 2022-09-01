<?php
    include_once "../assets/php/readDB.php";

    $readDB = new readDB();

    $lesson = $readDB->getMateri($_POST['lesson']);
    foreach($lesson as $i){
        $lessonPos = $i['nama_mapel'];
        echo "
        <option value='$lessonPos'>$lessonPos</option>
        ";
    }
?>