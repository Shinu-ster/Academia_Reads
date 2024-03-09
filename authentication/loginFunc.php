<?php
include '../database/dbconnect.php';
    if (isset($_POST['submit'])) {
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        $sql = "SELECT stu_id as id,semester as sem, NULL as is_admin,name FROM student WHERE username = '$user' AND password = '$pass' 
        UNION SELECT id, NULL as sem, is_admin,name FROM user WHERE username = '$user' AND password = '$pass'";
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
            header('location:http://localhost/4thsemProj/pages/display.php');
        } else {
            //if user doesn't exists prompt
            echo "not found";
        }
    }
    ?>