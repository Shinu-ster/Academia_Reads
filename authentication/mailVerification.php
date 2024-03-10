<?php
    if (!isset($_GET['code'])) {
        header('Location:login.php');
    }
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
    <title>Document</title>
</head>
<body>
    <form action="mailVeriFunc.php?code=<?php echo $_GET['code']?>" method="post">
        <h1>OTP Verification</h1>
        <input type="text" name="otp" id="">
        <button type="submit" name="verify">Submit</button>
    </form>
</body>
</html>