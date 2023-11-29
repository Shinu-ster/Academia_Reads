<?php
include '../database/dbconnect.php';
session_start();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $profile = $_SESSION['id'];
    // Allow to use this page only if the session exists
} else {
    header('location:http://localhost/4thsemProj/login/login.php');
    exit; // Add exit after the header to stop script execution
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/global.css">
</head>

<body>
    <?php
    include_once '../components/navbar.php';
    $sql = "SELECT COUNT(is_verify) AS count
    FROM pdf
    WHERE is_verify = 0 AND id = $profile";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        // echo $profile;
        $count = $row['count'];

        echo "Count <sup>" . $count. "</sup>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
// echo "Profile" .$profile;
    ?>
</body>

</html>