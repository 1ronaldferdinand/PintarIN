<?php
    class connectiondb{
        public $pdo;

        public function __construct(){
            try{
                $this->pdo = new PDO('mysql:host=localhost;dbname=pintarin', 'root', '');
            }catch(PDOException $e){
                echo "Error: " .$e->getMessage();
                exit();
            }
        }
    }
?>