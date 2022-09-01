<?php
    include_once "createDB.php";
    include_once "readDB.php";
    include_once "login.php";
    include_once "connectiondb.php";

    // $login = new login();

    // $_POST["email"] = "akunbersama38@gmail.com";
    // $_POST['password'] = "123";
    // $login->loginUser();
    // $_SESSION['id_user'];

    // $readDB = new readDB();
    // $user = $readDB->readUser($_POST["email"], $_POST['password']);
    // $values = $user->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($values);
    // echo "<br><br>";
    // var_dump($values[0]['id_user']);
    
    // $correct = $readDB->checkAnswer(0,'d');
    // $correct = $readDB->checkAnswer(1,'c');
    // $createDB = new createDB("");
    // $createDB->createSubmission($readDB->getScore($correct));

    function readQuizQuestion(){
        $conn = new connectiondb;
        $conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $id_kuis = $_GET['id_kuis'];
        
        $query = "SELECT * FROM kuis WHERE id_judul_kuis = '$id_kuis'";    
        $results = $conn->pdo->prepare($query);
        $results->execute();

        return $results;
    }

    function checkAnswer($index, $answer){
        $question = readQuizQuestion();
        $values = $question->fetchAll();

        static $correct = 0;

        if($values[$index]['jawaban_benar'] == $answer){
            $correct += 1;
        }
        return $correct;
    }

    function getScore($correct){
        $question = readQuizQuestion();
        $values = $question->fetchAll();
        $count = count($values);

        return $correct / $count * 100;
    }

    $readQuestion = readQuizQuestion();
    $question = $readQuestion->fetchAll();
    
    $index = isset($_POST['index']) ? $_POST['index'] : 0;
    $correct = isset($_POST['correct']) ? $_POST['correct'] : 0;
    $answer = isset($_POST['answer']) ? $_POST['answer'] : "0";

    if(isset($_POST['submit'])){
        $correct = checkAnswer($index, $answer);
        $index += 1;
    }

    var_dump($correct);
?>

<h4><?=$question[$index]['soal']?></h4>
            <br>
            <div>
            <form action="" method="post">
                <input type="hidden" name="index" value=<?=$index?>>
                <input type="hidden" name="correct" value="<?=$correct?>">
                <input type="radio" id="a" name="answer" value="a">
                <label for="a"><?=$question[$index]['jawaban_a']?></label><br>
                <input type="radio" id="b" name="answer" value="b">
                <label for="b"><?=$question[$index]['jawaban_b']?></label><br>
                <input type="radio" id="c" name="answer" value="c">
                <label for="c"><?=$question[$index]['jawaban_c']?></label><br>
                <input type="radio" id="d" name="answer" value="d">
                <label for="d"><?=$question[$index]['jawaban_d']?></label><br>
                <input type="radio" id="e" name="answer" value="e">
                <label for="e"><?=$question[$index]['jawaban_e']?></label><br>
                <input type="submit" value="kirim" name="submit">
            </form>
        </div>