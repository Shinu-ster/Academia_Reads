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
$delkey = $_GET['delete_key'];

$query = "SELECT * FROM pdf where f_id = $delkey";
$result = mysqli_query($conn, $query);
$row =  mysqli_fetch_assoc($result);

// Delete the file from the 'pdf' folder
$pdfFilePath = $row['file'];
if (file_exists($pdfFilePath)) {
    unlink($pdfFilePath);
}

// Delete the file from 'cover' folder
$coverFilePath = $row['cover'];
if (file_exists($coverFilePath)) {
    unlink($coverFilePath);
}
$deleteQuery = "
    DELETE FROM resource_comment where r_id = $delkey;
    DELETE FROM resource_feedback where r_id= $delkey;
    DELETE FROM `pdf` WHERE f_id = $delkey;";
$res = mysqli_multi_query($conn, $deleteQuery);
if ($res) {
    header('location:http://localhost/4thsemProj/pages/display.php');
    exit;
} else {
    echo "Invalid request!";
}
