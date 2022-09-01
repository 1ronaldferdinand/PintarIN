<?php
    include_once "readDB.php";

    $readDB = new readDB();

    if($_POST['classes'] == "All"){
        $readMapel = $readDB->readMapel();
        $mapel = $readMapel->fetchAll();

        for($i = 0; $i < count($mapel); $i++){
            $readMateri = $readDB->getValueFrom('materi', 'id_mapel', $mapel[$i]['id_mapel']);
            $materi = $readMateri->fetchAll();
            $readQuiz = $readDB->getValueFrom('judul_kuis', 'id_mapel', $mapel[$i]['id_mapel']);
            $quiz = $readQuiz->fetchAll();
            $image = $mapel[$i]['image'];
            $id = $mapel[$i]['id_mapel'];
            $count_materi = count($materi);
            $count_quiz = count($quiz);
            $nama_mapel = $mapel[$i]['nama_mapel'];
            $waktu = $mapel[$i]['time_required'];
            echo "
            <div class='col-lg-4 col-md-6 d-flex align-items-stretch'>
            <div class='course-item'>
                <img src='$image' class='img-fluid' alt='...'>
                <div class='course-content'>
                <h3><a href='materi.php?id_mapel=$id'>$nama_mapel</a></h3>
                <div>
                    <p class='card-text'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-book' viewBox='0 0 16 16'>
                        <path d='M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z'/>
                        </svg> $count_materi lessons 
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square ml-3' viewBox='0 0 16 16'>
                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                        </svg> $count_quiz tasks 
                    <i class='fab fa-youtube ml-3'>$waktu</i>
                    </p>
                </div>
                <div class='trainer d-flex justify-content-between align-items-center mt-5'>
                    <div class='trainer-profile d-flex align-items-center'>
                    <img src='assets/img/trainers/trainer-1.jpg' class='img-fluid' alt=''>
                    <span>Agung Samsul, M.Kom.</span>
                    </div>
                    <div class='trainer-rank d-flex align-items-center'>
                    <i class='bx bx-user'></i>&nbsp;50
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- End Course Item-->
            ";
        }
    }

    if(isset($_POST['loadMapel1'])){
        $readMapel = $readDB->readMapel($_POST['classes']);
        $mapel = $readMapel->fetchAll();

        if(count($mapel) == 0 && $_POST['classes'] != "All"){
            echo "<h3>Sorry, we still don't have any lesson for this class</h3>";
        }else{

            for($i = 0; $i < count($mapel); $i++){
                $readMateri = $readDB->getValueFrom('materi', 'id_mapel', $mapel[$i]['id_mapel']);
                $materi = $readMateri->fetchAll();
                $readQuiz = $readDB->getValueFrom('judul_kuis', 'id_mapel', $mapel[$i]['id_mapel']);
                $quiz = $readQuiz->fetchAll();
                $image = $mapel[$i]['image'];
                $id = $mapel[$i]['id_mapel'];
                $count_materi = count($materi);
                $count_quiz = count($quiz);
                $nama_mapel = $mapel[$i]['nama_mapel'];
                $waktu = $mapel[$i]['time_required'];
                echo "
                <div class='col-lg-4 col-md-6 d-flex align-items-stretch'>
                <div class='course-item'>
                    <img src='$image' class='img-fluid' alt='...'>
                    <div class='course-content'>
                    <h3><a href='materi.php?id_mapel=$id'>$nama_mapel</a></h3>
                    <div>
                        <p class='card-text'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-book' viewBox='0 0 16 16'>
                            <path d='M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z'/>
                            </svg> $count_materi lessons 
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square ml-3' viewBox='0 0 16 16'>
                            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                            </svg> $count_quiz tasks 
                        <i class='fab fa-youtube ml-3'>$waktu</i>
                        </p>
                    </div>
                    <div class='trainer d-flex justify-content-between align-items-center mt-5'>
                        <div class='trainer-profile d-flex align-items-center'>
                        <img src='assets/img/trainers/trainer-1.jpg' class='img-fluid' alt=''>
                        <span>Agung Samsul, M.Kom.</span>
                        </div>
                        <div class='trainer-rank d-flex align-items-center'>
                        <i class='bx bx-user'></i>&nbsp;50
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Course Item-->
                ";
            }
        }
    }

    // if($_POST['loadMapel2'] == "All"){
    //     $readMapel = $readDB->readMapel();
    //     $mapel = $readMapel->fetchAll();

    //     for($i = 0; $i < count($mapel); $i++){
    //         $readMateri = $readDB->getValueFrom('materi', 'id_mapel', $mapel[$i]['id_mapel']);
    //         $materi = $readMateri->fetchAll();
    //         $image = $mapel[$i]['image'];
    //         $id = $mapel[$i]['id_mapel'];
    //         $count_materi = count($materi);
    //         $nama_mapel = $mapel[$i]['nama_mapel'];
    //     }
    // }
    
?>