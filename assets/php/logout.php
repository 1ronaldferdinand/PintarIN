<?php
    class logout{
        public function logoutUser(){
            session_destroy();

            header("location:../index.php");
        }
    }
?>