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
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include_once '../components/navbar.php';

    $getinfo = "SELECT * FROM student where stu_id = '$profile'";
    $res = mysqli_query($conn, $getinfo);
    $row = mysqli_fetch_assoc($res);

    ?>
    <table border="1">
        <caption>
            <h1>Student profile</h1>
        </caption>
        <tr>
            <th>Full Name: </th>
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
        <tr>
            <th>Semester: </th>
            <td><?php echo $row['semester'] ?></td>
        </tr>
        <tr>
            <th>Verified: </th>
            <td><?php echo $is_verify =  $row['is_verified'] == 0 ?  "Not Verified": "Verified";?></td>
        </tr>

    </table>
</body>

</html>