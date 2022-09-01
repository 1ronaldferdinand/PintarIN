<?php
var_dump($_POST['logout']);
    if(isset($_POST['logout'])){
        $_POST['dt'] = "DATA";
  
        header("location:test1.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<a href="" onclick="logout()">add</a>
<!-- <input type="hidden" name="data" id="data"> -->
<div id="test"></div>
    <form action="test1.php" method="post">
    <a href="test1.php" onclick="klik()">add</a> -->
    <input type="submit" value="submit">
    </form>

    <script>
        function logout() {
        $.ajax({
            type: "POST",
            url: 'test1.php',
            data:{action:'logout', logout:true},
            success:function(response){
                $('#data').val = "123"
                $('#test').html(response);
                window.location.assign("test1.php");
            }
        });
    }
    </script>
</body>
</html>