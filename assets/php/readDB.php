<?php
    include_once "connectiondb.php";
    class readDB{
        private $conn;
        private $id_user;

        public function __construct(){
            // session_start();
            $this->conn = new connectiondb;
            $this->conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : "0";
        }

        public function getSingleValueFrom($tableName, $column, $search, $colKey){
            $query = "SELECT * FROM $tableName WHERE $column = $search";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            $value = $results->fetchAll();

            return $value[0]["$colKey"];
        }

        public function getValueFrom($tableName, $column, $search){
            $query = "SELECT * FROM $tableName WHERE $column = '$search'";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readAdmin($email, $password){
            $query = "SELECT * FROM admin WHERE email='$email' AND password='$password';";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readSubmission(){
            $id_materi = $_GET['id_materi'];
            $query = "SELECT * FROM submission WHERE id_user = '$this->id_user' AND id_materi = '$id_materi'";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readAllSubmission(){
            $query = "SELECT * FROM submission WHERE id_user = '$this->id_user'";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readMapel($class = null){
            if($class == null){
                $query = "SELECT * FROM mapel";
            }else{
                $query = "SELECT * FROM mapel where kategori='$class'";
            }
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readMateri(){
            $user = $this->readUserDetail($this->id_user);
            $values = $user->fetchAll();
            $status = $values[0]['status'];
            $id_mapel = $_GET['id_mapel'];
            if($status == "langganan"){
                $query = "SELECT * FROM materi WHERE id_mapel = '$id_mapel'";
            }else{
                $query = "SELECT * FROM materi WHERE id_mapel = '$id_mapel' AND status='gratis'";
            }
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function getCountMateri($id_mapel){
            $user = $this->readUserDetail($this->id_user);
            $values = $user->fetchAll();
            $status = $values[0]['status'];

            if($status == "langganan"){
                $query = "SELECT count(*) FROM materi WHERE id_mapel = '$id_mapel'";
            }else{
                $query = "SELECT count(*) FROM materi WHERE id_mapel = '$id_mapel' AND status='gratis'";
            }

            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            $materi = $results->fetchColumn();

            return $materi;
        }

        public function readTransaction(){
            $query = "SELECT * FROM transaksi WHERE id_user = '$this->id_user'";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readAllDiscussion(){
            $id_materi = $_GET['id_materi'];
            $query = "SELECT * FROM diskusi WHERE id_materi = '$id_materi'";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readDiscussionDetail(){
            $id_materi = $_GET['id_materi'];
            $parent_id = $_GET['parent_id'];
            $query = "SELECT * FROM diskusi WHERE id_materi = '$id_materi' AND parent_id_diskusi = '$parent_id'";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readUser($email, $password=NULL){
            $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readUserDetail(){
            $query = "SELECT * FROM user WHERE id_user = '$this->id_user'";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readExpiredTransaction(){
            $query = "SELECT * FROM transaksi WHERE id_user = '$this->id_user' ORDER BY sampai_tanggal DESC LIMIT 1";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();
            $values = $results->fetchAll();
            $now = date("d-m-Y H:i:s");
            $due_to = strtotime($values[0]['sampai_tanggal']);

            if($now > $due_to){
                $query = "UPDATE user SET status='gratis' WHERE id_user='$this->id_user';";
                $this->conn->pdo->exec($query);
            }
        }

        public function checkSubscriptions(){
            $user = $this->readUserDetail();
            $values = $user->fetch(PDO::FETCH_ASSOC);
            if($values['status'] == "langganan"){
                return True;
            }else{
                return False;
            }
        }

        public function checkAlreadyProgress($id_mapel, $id_user){
            $query = "SELECT * FROM progress WHERE id_user='$id_user' AND id_mapel='$id_mapel';";
            $results = $this->conn->pdo->prepare($query);
            $results->execute();
            $values = $results->fetchAll(PDO::FETCH_ASSOC);

            if(count($values) > 0){
                return False;
            }else{
                return True;
            }
        }

        public function getProgress(){
            $id_user = $_SESSION['id_user'];
            $id_mapel = $_GET['id_mapel'];

            $query = "SELECT COUNT(id_mapel) FROM progress WHERE id_user='$id_user' AND id_mapel='$id_mapel'";
            $progress = $this->conn->pdo->prepare($query);
            $progress->execute();
            return $progress->fetchColumn();
        }

        public function readQuizQuestion(){
            $id_kuis = $_GET['id_kuis'];
            
            $query = "SELECT * FROM kuis WHERE id_judul_kuis = '$id_kuis'";    
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function readQuizName(){
            $id_mapel = $_GET['id_mapel'];
            
            $query = "SELECT * FROM judul_kuis WHERE id_mapel = '$id_mapel'";    
            $results = $this->conn->pdo->prepare($query);
            $results->execute();

            return $results;
        }

        public function checkAnswer(){
            $id_user = $_SESSION['id_user'];
            $id_kuis = $_GET['id_kuis'];
            $query = "SELECT * FROM user_answer WHERE id_user = '$id_user' AND id_kuis='$id_kuis';";    
            $results = $this->conn->pdo->prepare($query);
            $results->execute();
            $userAnswer = $results->fetchAll();

            $question = $this->readQuizQuestion();
            $values = $question->fetchAll();

            $correct = 0;
            
            for($i = 0; $i < count($userAnswer); $i++){
                if($userAnswer[$i]['answer'] == $values[$i]['jawaban_benar']){
                    $correct += 1;
                }
            }
            return $correct;
        }

        public function getScore($correct){
            $question = $this->readQuizQuestion();
            $values = $question->fetchAll();
            $count = count($values);

            return $correct / $count * 100;
        }

        public function getMapel($class, $degree){
            $query = "SELECT * FROM mapel WHERE kelas = '$class' AND kategori='$degree';";    
            $results = $this->conn->pdo->prepare($query);
            $results->execute();
            return $results->fetchAll();
        }
        
        public function getIdJudulQuiz($title, $id_mapel){
            $query = "SELECT * FROM judul_kuis WHERE judul = '$title' AND id_mapel='$id_mapel'";    
            $results = $this->conn->pdo->prepare($query);
            $results->execute();
            return $results->fetchAll();
        }
    }
?>