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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/table.css?v=<?php echo time(); ?>">
    <style>
        th {
            background-color: rgb(151, 170, 200, 0.1);
            padding: 0.7%;
        }
    </style>
</head>

<body>
    <?php
    include_once '../components/navbar.php';
    $getinfo = "SELECT * FROM user where id = '$profile'";
    $res = mysqli_query($conn, $getinfo);
    $row = mysqli_fetch_assoc($res);
    ?>
    <table border="1">
        <caption>
            <h1>Admin Profile</h1>
        </caption>
        <tr>
            <th>Name: </th>
            <td><?php echo $row['name'] ?></td>
        </tr>
        <tr>
            <th>Username: </th>
            <td><?php echo $row['username'] ?></td>
        </tr>
        <tr>
            <th>Email: </th>
            <td><?php echo $row['email'] ?></td>
        </tr>
    </table>
</body>

</html>