<?php
include '../database/dbconnect.php';
session_start();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $profile = $_SESSION['id'];
    // Allow to use this page only if the session exists
} else {
    header('location:http://localhost/4thsemProj/authentication/login.php');
    exit; // Add exit after the header to stop script execution
}
if (isset($_POST['submit'])) {
    if (isset($_GET['id'])) {
        $stu_id = $_GET['id'];
        $reg_no = $_POST['regNo'];
        $updateregNo = "UPDATE student set reg_no = '$reg_no' where stu_id = '$stu_id'";
        $res = mysqli_query($conn,$updateregNo);
        if ($res) {
            echo '<script>alert("Your regsitration Number will be verified soon")</script>';
            header("Refresh:0;url=http://localhost/4thsemProj/profile/profile.php");
        }        
    }else{
        header("location:http://localhost/4thsemProj/pages/display.php");
    }
}else{
    header("location:http://localhost/4thsemProj/pages/display.php");
}