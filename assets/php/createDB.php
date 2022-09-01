<?php
    include_once "connectiondb.php";
    include_once "readDB.php";

    class createDB{
        private $conn;
        private $tableName;

        public function __construct($tableName){
            // session_start();
            $this->tableName = $tableName;
            $this->conn = new connectiondb;
            $this->conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        private function checkAlreadyEmail($email){
            $query = $query = "SELECT COUNT(email) FROM user WHERE email = '$email'";
            $result = $this->conn->pdo->prepare($query);
            $result->execute();
            $count = $result->fetchColumn();

            if($count > 0){
                return True;
            }else{
                return False;
            }
        }

        private function getValueFrom($tableName, $column, $search){
            $query = "SELECT * FROM $tableName WHERE $column = '$search'";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function createUser(){
            $email = $_POST['email'];
            if($this->checkAlreadyEmail($email)){
                return False;
            }else{
                $nama = $_POST['user_name'];
                $password = $_POST['password'];
                $no_telp = $_POST['no_telp'];
                $image = "assets\img\user\placeholder.png";
                $birthday = $_POST['birthday'];
                $query = "INSERT INTO user VALUES (NULL, '$nama', '$email', '$password', '$image', '$no_telp', '$birthday', 'gratis');";
                $this->conn->pdo->exec($query);

                $readDB = new readDB();
                $user = $readDB->readUser($_POST["email"], $_POST['password']);
                $values = $user->fetchAll(PDO::FETCH_ASSOC);

                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $nama;
                $_SESSION['id_user'] = $values[0]['id_user'];
                $_SESSION['picture'] = $values[0]['image'];

                return True;
            }
        }

        public function createMateri(){
            $id_admin = $_SESSION['id_admin'];
            $nama_materi = $_POST['title'];
            $url_video = $_POST['video_url'];
            $isi = $_POST['content'];
            if(isset($_POST['status'])){
                $status = "langganan";
            }else{
                $status = "gratis";
            }
            $nama_mapel = $_POST['lesson'];
            $mapel = $this->getValueFrom("mapel", "nama_mapel", $nama_mapel);
            $values = $mapel->fetchAll(PDO::FETCH_ASSOC);
            $id_mapel = $values[0]['id_mapel'];

            $query = "INSERT INTO materi VALUES (NULL, '$nama_materi', '$url_video', '$isi', '$status', '$id_mapel', '$id_admin');";
            $this->conn->pdo->exec($query);
        }

        public function createTransaction(){
            $id_user = $_SESSION['id_user'];
            $price = 100000;
            $now = date("d-m-Y H:i:s");
            $next_month = date("d-m-Y H:i:s", time() + (60 * 60 * 24 * 30));

            $queryUpdate = "UPDATE user SET status='langganan' WHERE id_user='$id_user';";
            $this->conn->pdo->exec($queryUpdate);

            $query = "INSERT INTO transaksi VALUES(NULL, '$now', '$price', '$id_user', '$next_month');";
            $this->conn->pdo->exec($query);
        }

        public function createSubmission($score){
            $now = date("d-m-Y H:i:s");
            $id_user = $_SESSION['id_user'];
            $id_kuis = $_GET['id_kuis'];
            $judul = $_GET['nama_kuis'];

            $readDB = new readDB();
            $mapel = $readDB->getValueFrom('mapel', 'id_mapel', $_GET['id_mapel']);
            $values = $mapel->fetchAll();
            $class = strval($values[0]['kelas']);

            $class = $class . " " . $values[0]['kategori'];

            $query = "INSERT INTO submission VALUES(NULL, '$judul', '$class', '$score', '$now', '$id_user', '1', '$id_kuis');";
            $this->conn->pdo->exec($query);
        }

        public function createQuizTitle(){
            $id_admin = $_SESSION['id_admin'];

            $title = $_POST['title'];
            $nama_mapel = $_POST['nama_mapel'];
            $mapel = $this->getValueFrom("mapel", "nama_mapel", $nama_mapel);
            $values_mapel = $mapel->fetchAll(PDO::FETCH_ASSOC);
            $id_mapel = $values_mapel[0]['id_mapel'];

            $query = "INSERT INTO judul_kuis VALUES(NULL, '$title', '$id_mapel', '$id_admin');";
            $this->conn->pdo->exec($query);
        }

        public function createQuiz(){
            $readDB = new readDB();
            $questions = $_POST['content'];
            $answer_a = $_POST['answer_a'];
            $answer_b = $_POST['answer_b'];
            $answer_c = $_POST['answer_c'];
            $answer_d = $_POST['answer_d'];
            $answer_e = $_POST['answer_e'];
            $correct_answer = $_POST['correct_answer'];
            $id_kuis = $_GET['id_judul_kuis'];
            $values = $readDB->getSingleValueFrom("judul_kuis", "id_judul_kuis", $id_kuis, "id_mapel");
            $id_mapel = $values;
            
            $query2 = "INSERT INTO kuis VALUES(NULL, '$questions', '$answer_a', '$answer_b', '$answer_c', '$answer_d', '$answer_e', '$correct_answer', '$id_mapel', '1', '$id_kuis');";
            $this->conn->pdo->exec($query2);
        }

        public function createCompleted(){
            $readDB = new readDB();

            $id_mapel = $_POST['id_mapel'];
            $id_materi = $_POST['id_materi'];
            $id_user = $_SESSION['id_user'];

            $query = "INSERT INTO selesai VALUES(NULL, '$id_materi', '$id_mapel', '$id_user');";
            $this->conn->pdo->exec($query);

            $queryGetMateri = "SELECT COUNT(id_materi) FROM materi WHERE id_mapel='$id_mapel'";
            $materi = $this->conn->pdo->prepare($queryGetMateri);
            $materi->execute();
            $materi_size = $materi->fetchColumn();

            $queryGetCompleted = "SELECT COUNT(id_materi) FROM selesai WHERE id_user='$id_user' AND id_mapel='$id_mapel'";
            $completed = $this->conn->pdo->prepare($queryGetCompleted);
            $completed->execute();
            $completed_size = $completed->fetchColumn();

            $progress = floor($completed_size/$materi_size * 100);

            if($readDB->checkAlreadyProgress($id_mapel, $id_user)){
                $query1 = "INSERT INTO progress VALUES(NULL, '$progress', '$id_mapel', '$id_user');";
                $this->conn->pdo->exec($query1);
            }else{
                $query = "UPDATE progress SET progress='$progress' WHERE id_mapel='$id_mapel' AND id_user='$id_user';";
                $this->conn->pdo->exec($query);
            }
        }

        public function createUserAnswer(){
            $id_mapel = $_GET['id_mapel'];
            $id_user = $_SESSION['id_user'];
            $id_kuis = $_GET['id_kuis'];
            $answer = $_POST['answer'];

            $query = "INSERT INTO user_answer VALUES(NULL, '$answer', '$id_user', '$id_mapel', '$id_kuis');";
            $this->conn->pdo->exec($query);
        }
    }
?>