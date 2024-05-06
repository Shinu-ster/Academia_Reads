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
        <h1>
            <center><b>Login</b></center>
        </h1>
        <form action="loginFunc.php" method="post">
            <label for="username">
                <input type="email" name="email" id="email" placeholder="Enter your Email" required autocomplete="off">
            </label>
            <br><br>
            <label for="password">
                <input type="password" name="password" id="password" required placeholder="Enter your Password" autocomplete="off">
            </label> <br> <br> <br>
            <button type="submit" name="submit">Submit</button>
        </form>
        <center><a href="./register.php">Dont have an account?</a></center>
        
    </div>
</body>

</html>