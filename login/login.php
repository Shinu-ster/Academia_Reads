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
        <form action="" method="post">
            <label for="username">
                Username: <input type="text" name="username" id="username" placeholder="Enter your Username" required>
            </label>
            <br><br>
            <label for="password">
                Password: <input type="password" name="password" id="password" required placeholder="Enter your Password">
            </label> <br> <br> <br>
            <button type="submit" name="submit">Submit</button>
        </form>
        <a href="../register/register.php">Dont have an account?</a>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        $sql = "SELECT stu_id as id,semester as sem, NULL as is_admin,name FROM student WHERE username = '$user' AND password = '$pass' 
        UNION SELECT id, NULL as sem, is_admin,name FROM user WHERE username = '$user' AND password = '$pass'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            //if exists create session and 
            //redirect to home page
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['is_admin'] = $row['is_admin'];
            $_SESSION['sem'] = $row['sem'];
            header('location:http://localhost/4thsemProj/pages/display.php');
        } else {
            //if user doesn't exists prompt
            echo "not found";
        }
    }
    ?>
</body>

</html>