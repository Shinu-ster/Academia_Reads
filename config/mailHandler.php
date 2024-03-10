<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php";

function sendEmail($sender, $receiver, $otp, $activation_code)
{
    $mail = new PHPMailer(true);
    try {
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'intakolai@gmail.com';
        $mail->Password = 'xktncuemdgatlafm';
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Port = '587';

        $mail->setFrom($sender, 'DAV College');
        $mail->addAddress($receiver, 'User Name');
        $mail->isHTML(true);
        $mail->Subject = "OTP Verification | ACADEMIA READS";
        $mail->Body = "Your verificaiton OTP IS <strong>$otp</strong>";
        if ($mail->send()) {
            echo '<script>confirm("Please check your email for verification code")</script>';
            header('location:http://localhost/4thsemProj/authentication/mailVerification.php?code=' . $activation_code);
        }
    } catch (Exception $e) {
        echo "Failed to send mail. Error message{$e->getMessage()}";
    }
}
