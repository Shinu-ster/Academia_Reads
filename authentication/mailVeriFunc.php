<?php
include "../database/dbconnect.php";

date_default_timezone_set("Asia/Kathmandu");

// Initialize response array
// $responseData = array();
$responseData = "";
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $activation_code = $_POST['code'];
    $otp = $_POST['otp'];

    $sqlSelect = "SELECT * FROM (
            SELECT signup_time, otp, activation_code FROM user
            UNION
            SELECT signup_time, otp, activation_code FROM student
        ) AS combined_table
        WHERE activation_code = '$activation_code';";
    $response = mysqli_query($conn, $sqlSelect);
    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        $rowotp = $row['otp'];
        $rowSignupTime = $row['signup_time'];
        $rowSignupTime = date('Y-m-d H:i:s', strtotime($rowSignupTime));
        $rowSignupTime = strtotime($rowSignupTime);
        $timeup = strtotime('+2 minutes', $rowSignupTime);

        if ($rowotp != $otp) {
            // $responseData['success'] = false;
            // $responseData['message'] = 'Incorrect OTP';
            $response = 'Incorrect OTP';
            // echo json_encode(["message" =>$responseData['message']]);
            echo $response;
        } else {
            if (time() >= $timeup) {
                // $responseData['success'] = false;
                $responseData = 'Time is up. Please try again.';
                echo $responseData;
            } else {
                $sqlUpdate = "UPDATE user
                    SET status = 'active'
                    WHERE activation_code = '$activation_code';
                    UPDATE student
                    SET status = 'active'
                    WHERE activation_code = '$activation_code';";
                $responseupdate = mysqli_multi_query($conn, $sqlUpdate);
                if ($responseupdate) {
                    // $responseData['success'] = true;
                    $responseData = 'Account activated successfully';
                    echo $responseData;
                } else {
                    // $responseData['success'] = false;
                    $responseData = 'Failed to activate account';
                    echo $responseData;
                }
            }
        }
    } else {
        // $responseData['success'] = false;
        // $responseData['message'] = 'Invalid activation code';
        $response = 'Invalid Activation Code';
        // echo json_encode(["message" =>$responseData['message']]);
        echo $response;
    }
} else {
    echo "No otp or activation code";
}
