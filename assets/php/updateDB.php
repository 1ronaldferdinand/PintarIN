<?php

    include_once 'connectiondb.php';
    include_once 'readDB.php';
    
    class updateDB{
        private $conn;
        private $readDB;

        public function __construct(){
            // session_start();
            $this->conn = new connectiondb;
            $this->conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->readDB = new readDB();
        }

        public function updateUser(){
            $id_user = $_SESSION['id_user'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $no_telp = $_POST['no_telp'];
            $base_url = "";
            $file = $base_url . basename($_FILES['file']['name']);
            $fileTipe = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES['file']['tmp_name']);
            if($check){
                $query = "UPDATE user SET name='$name', email='$email', password='$password', no_telp='$no_telp', image='$file' WHERE user.id='$id_user';";
                $this->conn->pdo->exec($query);
                return True;
            }else{
                return False;
            }
        }

        public function updateMateri(){
            $nama_materi = $_POST['title'];
            $url_video = $_POST['video_url'];
            $isi = $_POST['content'];
            $id_materi = $_GET['id_materi'];
            $id_mapel = $_POST['id_mapel'];
            
            // var_dump($id_mapel);

            if(empty($_POST['status'])){
                $status = "gratis";
            }else{
                $status = 'langganan';
            }

            $query = "UPDATE materi SET nama_materi='$nama_materi', video='$url_video', isi='$isi', status='$status' WHERE id_materi='$id_materi';";
            $this->conn->pdo->exec($query);
        }

        public function updateJudulKuis(){
            $id_kuis = $_GET['id_judul_kuis'];
            $title = $_POST['title'];
            $id_admin = $_SESSION['id_admin'];
            $nama_mapel = $_POST['nama_mapel'];
            $mapel = $this->readDB->getValueFrom("mapel", "nama_mapel", $nama_mapel);
            $values_mapel = $mapel->fetchAll(PDO::FETCH_ASSOC);
            $id_mapel = $values_mapel[0]['id_mapel'];

            $query = "UPDATE judul_kuis SET judul='$title', id_mapel='$id_mapel', id_admin='$id_admin' WHERE id_judul_kuis='$id_kuis';";
            $this->conn->pdo->exec($query);
        }

        public function updateQuiz(){
            $id_kuis = $_GET['id_kuis'];
            $questions = $_POST['content'];
            $answer_a = $_POST['answer_a'];
            $answer_b = $_POST['answer_b'];
            $answer_c = $_POST['answer_c'];
            $answer_d = $_POST['answer_d'];
            $answer_e = $_POST['answer_e'];
            $correct_answer = $_POST['correct_answer'];

            $query = "UPDATE kuis SET soal='$questions', jawaban_a='$answer_a', jawaban_b='$answer_b', jawaban_c='$answer_c', jawaban_d='$answer_d', jawaban_e='$answer_e', jawaban_benar='$correct_answer' WHERE id_kuis='$id_kuis';";
            $this->conn->pdo->exec($query);
        }
    }
?>