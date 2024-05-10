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
    <title>Login</title>
    <link rel="stylesheet" href="../styles/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">

</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="loginFunc.php" method="post">
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email" required autocomplete="off">
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" required placeholder="Password" autocomplete="off">
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Login</button>
            </div>
        </form>
        <div class="register-link">
            Don't have an account? <a href="./register.php">Register</a>
        </div>
    </div>
</body>

</html>
