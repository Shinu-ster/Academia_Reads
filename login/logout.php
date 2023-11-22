<?php
session_start();
$profile = $_SESSION['id'];
if($profile == true){

session_unset();
session_destroy();
header('location:http://localhost/4thsemProj/login/login.php');
}
else{
    header('location:http://localhost/4thsemProj/pages/addpdf.php');
}
?>