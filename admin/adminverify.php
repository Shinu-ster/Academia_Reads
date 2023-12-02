<?php

    include '../database/dbconnect.php';
    session_start();
   if( $_SESSION['is_admin'] = 5){
    echo $_SESSION['is_admin'];
   }
   else{
    header('location:http://localhost/4thsemProj/crud/addpdf.php');
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
    
</body>
</html>