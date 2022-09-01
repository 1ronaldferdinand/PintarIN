<?php
    include_once "readDB.php";
    class login{
        public function loginUser(){
            session_start();

            $readDB = new readDB();
            $user = $readDB->readUser($_POST["email"], $_POST['password']);
            $values = $user->fetchAll(PDO::FETCH_ASSOC);
            $count = count($values);

            if($count > 0){
                $_SESSION['user_email'] = $_POST["email"];
                $_SESSION['user_name'] = $values[0]['nama'];
                $_SESSION['id_user'] = $values[0]['id_user'];
                $_SESSION['picture'] = $values[0]['image'];

                return True;
            }else{
                return False;
            }
        }

        public function loginAdmin($email, $password){
            session_start();
            $readDB = new readDB();
            $admin = $readDB->readAdmin($email, $password);
            $values = $admin->fetchAll();
            if($values > 0){
                $_SESSION['email_admin'] = $_POST["email"];
                $_SESSION['user_name_admin'] = $values[0]['nama'];
                $_SESSION['id_admin'] = $values[0]['id_admin'];
                return True;
            }else{
                return False;
            }
        }
    }
?>