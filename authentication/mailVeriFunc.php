<?php

include "../database/dbconnect.php";

if (isset($_POST['verify'])) {
    if (isset($_GET['code'])) {
        $activation_code = $_GET['code'];
        $opt = $_POST['otp'];
        $sqlSelect = "SELECT * FROM (
            SELECT signup_time, otp, activation_code FROM user
            UNION
            SELECT signup_time, otp, activation_code FROM student
        ) AS combined_table
        WHERE activation_code = '$activation_code';";
        $response = mysqli_query($conn, $sqlSelect);
        if (mysqli_num_rows($response) > 0) {
            $row = mysqli_fetch_assoc($response);
            $fetchedotp = $row['otp'];
            $testtime = $row['signup_time'];
            $fetchedSignupTime = strtotime($row['signup_time']); // Convert signup time to timestamp
            $timeup = strtotime('+5 minutes', $fetchedSignupTime);
            if ($fetchedotp != $opt) {
                echo "<script>alert('Please enter Correct otp')</script>";
                header('Refresh:0;url=mailVerification.php?code='.$activation_code);
            } else {
                if (time() >= $timeup) {
                    echo "<script>alert('Your time is up try again...')</script>";
                    header('Refresh:0;url=register.php');
                } else {
                    $sqlUpdate = "UPDATE user
                        SET status = 'active'
                        WHERE activation_code = '$activation_code';
                        UPDATE student
                        SET status = 'active'
                        WHERE activation_code = '$activation_code';";
                    $responseUpdate = mysqli_multi_query($conn, $sqlUpdate);
                    if ($responseUpdate) {
                        echo "<script>alert('Your Account has been created')</script>";
                        header('Refresh:0;url=login.php');
                    } else {
                        echo "<script>alert('Something went wrong')</script>";
                        header('Refresh:0;url=register.php');
                    }
                }
            }
        } else {
            header("Location:http://localhost/4thsemProj/404/404.php");
            exit();
        }
    }
}
