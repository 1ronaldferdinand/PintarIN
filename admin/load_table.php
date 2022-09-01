<?php
    include_once "../assets/php/connectiondb.php";
    include_once "../assets/php/readDB.php";

    function readDataLesson($table, $kategori = null){
        $conn = new connectiondb();
        $conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($kategori == null){
            $query = "SELECT * FROM $table ORDER BY id_admin DESC";
        }else{
            $query = "SELECT * FROM mapel as mp JOIN materi as mt ON mp.id_mapel = mt.id_mapel WHERE mp.kategori='$kategori' ORDER BY mp.kelas ASC";
        }
        $results = $conn->pdo->prepare($query);
        $results->execute();

        // var_dump($results);

        return $results->fetchAll();
    }

    function readDataQuizTitle($table, $kategori = null){
        $conn = new connectiondb();
        $conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($kategori == null){
            $query = "SELECT * FROM $table ORDER BY id_judul_kuis DESC";
        }else{
            $query = "SELECT * FROM mapel as mp JOIN judul_kuis as qz ON mp.id_mapel = qz.id_mapel WHERE mp.kategori='$kategori' ORDER BY mp.kelas ASC";
        }
        $results = $conn->pdo->prepare($query);
        $results->execute();

        // var_dump($results);

        return $results->fetchAll();
    }

    function readDataQuiz($table, $id_kuis){
        $conn = new connectiondb();
        $conn->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM $table WHERE id_judul_kuis='$id_kuis' ORDER BY id_judul_kuis ASC";
        $results = $conn->pdo->prepare($query);
        $results->execute();

        // var_dump($results);

        return $results->fetchAll();
    }

    function load_lesson(){
        $readDB = new readDB();
        $cls = $_POST['classes1'];

        $lessons = readDataLesson("materi", $cls);
        // var_dump($lessons);

        foreach($lessons as $lesson){
            $name = $lesson['nama_materi'];
            $video = $lesson['video'];
            $content = substr(htmlspecialchars($lesson['isi']),0, 200);
            $status = $lesson['status'];
            $id = $lesson['id_materi'];
            $values = $readDB->getValueFrom('mapel', "id_mapel", $lesson['id_mapel']);
            $classes = $values->fetchAll();
            $class = $classes[0]['kelas'] . " " . $classes[0]['kategori'];

            echo "
                <tr>
                    <td>
                        $name
                    </td>
                    <td>
                        $class
                    </td>
                    <td>
                        $video
                    </td>
                    <td>
                        <span class='text-wrap' style='max-width: 300px;'>$content</span>
                    </td>
                    <td>
                        $status
                    </td>
                    <td>
                        <div style='width:150px;'>
                            <a onclick='updateData($id)' href='lesson_update.php?id_materi=$id&action=updateLesson'><button type='button' class='btn-outline-primary'>Update</button></a>
                             | 
                            <a onclick='deleteData($id)' href=''><button type='button' class='btn-outline-danger'>Delete</button></a>
                        <div>
                            
                        </div>
                    </td>
                </tr>
            ";
        }
    }

    function load_lessonAll(){
        $readDB = new readDB();
        $lessons = readDataLesson("materi");

        foreach($lessons as $lesson){
            $name = $lesson['nama_materi'];
            $video = $lesson['video'];
            $content = substr(htmlspecialchars($lesson['isi']),0, 200);
            $status = $lesson['status'];
            $id = $lesson['id_materi'];
            $values = $readDB->getValueFrom('mapel', "id_mapel", $lesson['id_mapel']);
            $classes = $values->fetchAll();
            $class = $classes[0]['kelas'] . " " . $classes[0]['kategori'];

            echo "
                <tr>
                    <td>
                        $name
                    </td>
                    <td>
                        $class
                    </td>
                    <td>
                        $video
                    </td>
                    <td>
                        <span class='text-wrap' style='max-width: 300px;'>$content</span>
                    </td>
                    <td>
                        $status
                    </td>
                    <td>
                        <div style='width:150px;'>
                            <a onclick='updateData($id)' href='lesson_update.php?id_materi=$id&action=updateLesson'><button type='button' class='btn-outline-primary'>Update</button></a>
                             | 
                            <a onclick='deleteData($id)' href=''><button type='button' class='btn-outline-danger'>Delete</button></a>
                        <div>
                            
                        </div>
                    </td>
                </tr>
            ";
        }
    }

    function load_quizTitleAll(){
        $readDB = new readDB();
        $quises = readDataQuizTitle("judul_kuis");

        foreach($quises as $quiz){
            $name = $quiz['judul'];
            $id = $quiz['id_judul_kuis'];
            $values = $readDB->getValueFrom('mapel', "id_mapel", $quiz['id_mapel']);
            $classes = $values->fetchAll();
            $class = $classes[0]['kelas'] . " " . $classes[0]['kategori'];

            echo "
                <tr>
                    <td>
                        $name
                    </td>
                    <td>
                        $class
                    </td>
                    <td>
                        <div style='width:250px;'>
                            <a href='quiz_list.php?id_judul_kuis=$id'><button type='button' class='btn-outline-success'>Insert</button></a>
                             | 
                             <a href='quiz_update.php?id_judul_kuis=$id&action=updateTitle'><button type='button' class='btn-outline-primary'>Update</button></a>
                             | 
                            <a onclick='deleteQuiz($id)' href=''><button type='button' class='btn-outline-danger'>Delete</button></a>
                        <div>
                            
                        </div>
                    </td>
                </tr>
            ";
        }
    }

    function load_quizTitle(){
        $readDB = new readDB();
        $cls = $_POST['classes1'];

        $quises = readDataQuizTitle("materi", $cls);
        // var_dump($lessons);

        foreach($quises as $quiz){
            $name = $quiz['judul'];
            $id = $quiz['id_judul_kuis'];
            $values = $readDB->getValueFrom('mapel', "id_mapel", $quiz['id_mapel']);
            $classes = $values->fetchAll();
            $class = $classes[0]['kelas'] . " " . $classes[0]['kategori'];

            echo "
                <tr>
                    <td>
                        $name
                    </td>
                    <td>
                        $class
                    </td>
                    <td>
                        <div style='width:250px;'>
                            <a href='quiz_update.php?id_judul_kuis=$id'><button type='button' class='btn-outline-success'>Insert</button></a>
                             | 
                             <a href='quiz_update.php?id_judul_kuis=$id&action=updateTitle'><button type='button' class='btn-outline-primary'>Update</button></a>
                             | 
                            <a onclick='deleteQuiz($id)' href=''><button type='button' class='btn-outline-danger'>Delete</button></a>
                        <div>
                            
                        </div>
                    </td>
                </tr>
            ";
        }
    }

    function load_quiz(){
        // var_dump($_POST['id_judul_kuis']);
        $quises = readDataQuiz("kuis", $_POST['id_judul_kuis']);

        foreach($quises as $quiz){
            $question = $quiz['soal'];
            $id = $quiz['id_kuis'];
            $id_judul = $_POST['id_judul_kuis'];
            $answer_a = $quiz['jawaban_a'];
            $answer_b = $quiz['jawaban_b'];
            $answer_c = $quiz['jawaban_c'];
            $answer_d = $quiz['jawaban_d'];
            $answer_e = $quiz['jawaban_e'];
            $correct_answer = $quiz['jawaban_benar'];

            echo "
                <tr>
                    <td>
                        $question
                    </td>
                    <td>
                        $answer_a
                    </td>
                    <td>
                        $answer_b
                    </td>
                    <td>
                        $answer_c
                    </td>
                    <td>
                        $answer_d
                    </td>
                    <td>
                        $answer_e
                    </td>
                    <td>
                        $correct_answer
                    </td>
                    <td>
                        <div style='width:150px;'>
                            <a onclick='updateDataQuiz($id)' href='quiz_update.php?id_judul_kuis=$id_judul&id_kuis=$id&action=updateQuiz'><button type='button' class='btn-outline-primary'>Update</button></a>
                             | 
                            <a onclick='deleteQuiz($id)' href=''><button type='button' class='btn-outline-danger'>Delete</button></a>
                        <div>
                            
                        </div>
                    </td>
                </tr>
            ";
        }
    }

    if(isset($_POST['load_lesson']) == "load_lesson" && $_POST['classes1'] == "All"){
        load_lessonAll();
        // var_dump($_POST['classes1']);
    }else if(isset($_POST['load_lesson']) == "load_lesson"){
        // var_dump($_POST['classes1']);
        load_lesson();
    }

    if(isset($_POST['load_quiz']) == "quiz" && $_POST['classes1'] == "All"){
        load_quizTitleAll();
    }else if(isset($_POST['load_quiz']) == "quiz"){
        load_quizTitle();
    }

    if(isset($_POST['load_quiz_list']) == "quiz_list"){
        load_quiz();
    }
?>