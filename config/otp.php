<?php 
function generateotp()
{
    $otp_str = str_shuffle("0123456789");
    $otp = substr($otp_str, 0, 6);
    return $otp;
}