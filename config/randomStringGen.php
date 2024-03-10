<?php
function generateActivationCode()
{
    $acti_str = rand(100000, 100000000);
    $activation_code = str_shuffle("abcdefghij" . $acti_str);
    return $activation_code;
}
