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

</head>

<body>
    <?php
    include_once '../components/navbar.php';

    $getinfo = "SELECT * FROM student inner join semester on semester.sem_id = student.semester where stu_id = '$profile'";
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
            <th>Registration No:</th>
            <td><?php echo $reg_no = $row['reg_no'] == NULL && $row['is_verified'] == 0? "Not Verified": $row['reg_no']?></td>
        </tr>
        <tr>
            <th>Verified: </th>
            <td><?php echo $is_verify =  $row['is_verified'] == 0 ?  "Not Verified" : "Verified"; ?></td>
        </tr>
    </table>
    <br>
    <?php
if ($row['reg_no'] == NULL && $row['is_verified'] == 0 ) {
    
    if ($reg_no == "Not Verified") {
        ?>
        <form action="../verification/regVeriFunc.php?id=<?php echo $_SESSION['id']?>" method="post" style="margin-top: 20px; padding: 10px; background-color: #f0f0f0;">
            Enter your Registration No to be Verified: <br> 
            <input type="text" name="regNo" id="" style="width: 200px; padding: 5px; margin-bottom: 10px;">
            <button type="submit" name="submit" style="padding: 5px 10px; background-color: #4CAF50; color: white; border: none; border-radius: 3px; cursor: pointer;">Submit</button>
        </form>
        <?php
    }
} else if($row['is_verified'] == 0 ){

    echo '<div style="margin-top: 20px; padding: 10px; background-color: #f0f0f0;">Your account will be verified soon</div>';
}
else{
}
?>

</body>

</html>