<?php
include '../database/dbconnect.php';
session_start();
if (isset($_SESSION['id'])) {
    //if session exists redirect to home page
    header('location:http://localhost/4thsemProj/crud/addpdf.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/login.css?v=<?php echo time(); ?>">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="loginFunc.php" method="post">
            <label for="username">
                Username: <input type="text" name="username" id="username" placeholder="Enter your Username" required>
            </label>
            <br><br>
            <label for="password">
                Password: <input type="password" name="password" id="password" required placeholder="Enter your Password">
            </label> <br> <br> <br>
            <button type="submit" name="submit">Submit</button>
        </form>
        <a href="./register.php">Dont have an account?</a>
    </div>
</body>

</html>