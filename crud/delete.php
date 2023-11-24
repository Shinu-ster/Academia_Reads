<?php
    include '../database/dbconnect.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        $profile = $_SESSION['id'];
        // Allow to use this page only if the session exists
    } else {
        header('location:http://localhost/4thsemProj/login/login.php');
        exit; // Add exit after the header to stop script execution
    }
    $delkey = $_GET['delete_key'];
    echo $delkey;
    $sql = "DELETE FROM `pdf` WHERE f_id = $delkey";
    $res = mysqli_query($conn,$sql);   
    if($res){
        header('location:http://localhost/4thsemProj/pages/display.php');
        exit;
    }
?>
