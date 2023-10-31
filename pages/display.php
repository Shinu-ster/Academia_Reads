<?php
    include '../database/dbconnect.php';
    session_start();
    $profile = $_SESSION['id'];
    if($profile == true){
        //allow to use this page only if session exists
        // echo "session exists";
    }else{
        header('location:http://localhost/4thsemProj/login/login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<embed src="../pdf/Untitled 1.pdf" type="application/pdf" width="1000px" height="600px" />
</body>
</html>