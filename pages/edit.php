<?php
 include '../database/dbconnect.php';
 session_start();
     $f_id = $_GET['edit'];
     if($f_id == true){
         $sql1 = "SELECT * FROM pdf WHERE f_id = '$f_id'";
         $result1 = mysqli_query($conn,$sql1);
         $row1 = mysqli_fetch_assoc($result1);
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