<?php
include '../database/dbconnect.php';
include '../config/randomStringGen.php';
include '../config/otp.php';
session_start();
$otp = generateotp();
$activation_code = generateActivationCode();

if ($_POST['role'] == 'teacher') {
    if (isset($_POST['submit'])) {
        require_once "../config/mailHandler.php";
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = md5($_POST['password']);
        // $pattern = '/^[a-zA-Z0-9._%+-]+admin+@davnepal\.edu\.np$/';
        $pattern = '/^[a-zA-Z0-9._%+-]+@gmail\.com$/';
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        if (!preg_match($pattern, $email)) {
            echo "<script>alert('Email must be from DAV domain');</script>";
            header('Refresh:0;url=register.php');
        } else {
            $selectSQL = "SELECT * FROM user where email = '$email'";
            $response = mysqli_query($conn, $selectSQL);
            if (mysqli_num_rows($response) > 0) {
                $row = mysqli_fetch_assoc($response);
                $status = $row['status'];
                if ($status == 'active') {
                    echo "<script>alert('Email is already registered')</script>";
                } else {
                    // Update the existing teacher record
                    $sqlUpdate = "UPDATE user 
                              SET name = '$name', password = '$pass', otp = '$otp', activation_code = '$activation_code' 
                              WHERE email = '$email'";
                    $updateResult = mysqli_query($conn, $sqlUpdate);
                    if ($updateResult) {
                        sendEmail("intakolai@gmail.com", $email, $otp, $activation_code);
                    }
                }
            } else {
                // Insert a new teacher record
                $registerSQL = "INSERT INTO `user`(`username`, `name`, `email`, `password`, `otp`, `activation_code`) 
                            VALUES ('$user','$name','$email','$pass','$otp','$activation_code')";
                if (!mysqli_query($conn, $registerSQL)) {
                    echo "Request Failed";
                    exit();
                }
                sendEmail("intakolai@gmail.com", $email, $otp, $activation_code);
            }
        }
    }
} elseif ($_POST['role'] == 'student') {
    if (isset($_POST['submit'])) {
        require_once "../config/mailHandler.php";
        $name = $_POST['name'];
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        $pattern = '/^[a-zA-Z0-9._%+-]+@davnepal\.edu\.np$/';
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        if (!preg_match($pattern, $email)) {
            echo "<script>alert('Email must be from DAV domain');</script>";
            header('Refresh:0;url=register.php');
        } else {
            $sem = $_POST['sem'];
            $selectSQL = "SELECT * FROM student where email = '$email'";
            $response = mysqli_query($conn, $selectSQL);
            if (mysqli_num_rows($response) > 0) {
                $row = mysqli_fetch_assoc($response);
                $status = $row['status'];
                if ($status == 'active') {
                    echo "<script>alert('Email is already registered')</script>";
                } else {
                    $sqlUpdate = "UPDATE student SET name = '$name', password = '$pass',otp = '$otp',activation_code = '$activation_code'";
                    $updateResult = mysqli_query($conn, $sqlUpdate);
                    if ($updateResult) {
                        sendEmail("intakolai@gmail.com", $email, $otp, $activation_code);
                    }
                }
            } else {
                $registerSQL = "INSERT INTO `student`( `username`, `name`, `email`, `password`, `semester`, `otp`, `activation_code`) VALUES ('$user','$name','$email','$pass','$sem','$otp','$activation_code')";

                if (!mysqli_query($conn, $registerSQL)) {
                    echo "Request Failed";
                    exit();
                }
                sendEmail("intakolai@gmail.com", $email, $otp, $activation_code);
            }
            // $sql = "INSERT INTO student (username,name,email,password,semester) values('$user','$name','$email','$pass','$sem')";
            // $result = mysqli_query($conn, $sql);
            // if ($result) {
            //     //redirect to login
            //     header('location:http://localhost/4thsemProj/authentication/login.php');
            // } else {
            //     echo "Error: " . mysqli_error($conn);
            // }
        }
    }
}