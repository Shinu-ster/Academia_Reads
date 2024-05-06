<?php
include '../database/dbconnect.php';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $sql = "SELECT stu_id as id,semester as sem, NULL as is_admin,name,is_verified FROM student WHERE email = '$email' AND password = '$pass' 
        UNION SELECT id, NULL as sem, is_admin,name,NULL as is_verified FROM user WHERE email = '$email' AND password = '$pass'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        //if exists create session and 
        //redirect to home page
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['is_admin'] = $row['is_admin'];
        $_SESSION['sem'] = $row['sem'];
        $_SESSION['is_verified'] = $row['is_verified'];
        header('location:http://localhost/4thsemProj/pages/display.php');
    } else {
        //if user doesn't exists prompt
        echo "<script>alert('Invalid Email or Password')</script>";
        header('Refresh:0;url=login.php');
    }
}
