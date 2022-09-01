<?php
    include_once "connectiondb.php";

    class deleteDB{
        private $conn;

        public function __construct(){
            $this->conn = new connectiondb;
            $this->conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function deleteUserAnswer(){
            $id_kuis = $_GET['id_kuis'];
            $id_user = $_SESSION['id_user'];
            $query = "DELETE FROM user_answer WHERE id_user='$id_user' AND id_kuis = '$id_kuis';";
            $this->conn->pdo->exec($query);
        }
    }

    if(isset($_POST['delete'])){
        $conn = new connectiondb;
        $conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id_materi = $_POST['id_materi'];
        $query = "DELETE FROM materi WHERE id_materi='$id_materi';";
        $conn->pdo->exec($query);
    }

    if(isset($_POST['deleteQuiz']) == "quiz"){
        $conn = new connectiondb;
        $conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id_judul_kuis = $_POST['id_kuis'];
        $query = "DELETE FROM kuis WHERE id_judul_kuis='$id_judul_kuis';";
        $conn->pdo->exec($query);
        $query = "DELETE FROM judul_kuis WHERE id_judul_kuis='$id_judul_kuis';";
        $conn->pdo->exec($query);
    }

    if(isset($_POST['deleteQuiz']) == "delete"){
        $conn = new connectiondb;
        $conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id_kuis = $_POST['id_kuis'];
        $query = "DELETE FROM kuis WHERE id_kuis='$id_kuis';";
        $conn->pdo->exec($query);
    }
?>