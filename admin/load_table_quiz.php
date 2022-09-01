<?php
    include_once "../assets/php/connectiondb.php";
    include_once "../assets/php/readDB.php";

    function readData($table, $kategori = null){
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

    function load_lesson(){
        $readDB = new readDB();
        $cls = $_POST['classes1'];

        $lessons = readData("materi", $cls);
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
                            <a onclick='updateData($id)' href='lesson_update.php?id_materi=$id'><button type='button' class='btn-outline-primary'>Update</button></a>
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
        $lessons = readData("materi");

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
                            <a onclick='updateData($id)' href='lesson_update.php?id_materi=$id'><button type='button' class='btn-outline-primary'>Update</button></a>
                             | 
                            <a onclick='deleteData($id)' href=''><button type='button' class='btn-outline-danger'>Delete</button></a>
                        <div>
                            
                        </div>
                    </td>
                </tr>
            ";
        }
    }

    if($_POST['classes1'] == "All"){
        load_lessonAll();
        // var_dump($_POST['classes1']);
    }else{
        // var_dump($_POST['classes1']);
        load_lesson();
    }
?>