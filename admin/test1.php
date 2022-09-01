<?php
    if(isset($_POST['logout'])){
        echo "
        <p>Hai</p>
        ";
    }
    if(isset($_POST['data'])){
        echo "Berhasil";
    }
    var_dump($_POST['data']);
?>