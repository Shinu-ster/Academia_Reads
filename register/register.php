<?php
    include '../database/dbconnect.php';
    session_start();
    if(isset($_SESSION['id'])){
        //if session exists redirect to home page
        header('location:http://localhost/4thsemProj/pages/addpdf.php');
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        Username: <input type="text" name="username" id=""><br>
        Password: <input type="password" name="password" id=""><br>
        Email: <input type="email" name="email" id=""> <br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <?php
    if(isset($_POST['submit'])){
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        $email = $_POST['email'];
        $sql = "INSERT INTO user (username,password,email) values('$user','$pass','$email')";
        $result = mysqli_query($conn,$sql);
        if($result){
          //redirect to login
          header('location:http://localhost/4thsemProj/login/login.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>