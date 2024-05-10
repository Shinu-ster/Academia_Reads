<?php
session_start();
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
    <link rel="stylesheet" href="../styles/otp.css">
</head>
<body>
    <!-- <form action="mailVeriFunc.php?code=<?php echo $_GET['code']?>" method="post">
        <h1>OTP Verification</h1>
        <input type="text" name="otp" id="">
        <button type="submit" name="verify">Submit</button>
    </form> -->
    <div class="opt-card">
            <form action="" method="post" id="otpForm">
                <h1>OTP</h1>
                <p>Code has been sent to <span id="showMail"></span></p>
                <div class="otp-card-inputs">
                    <input type="text" name="" id="" maxlength="1" autofocus>
                    <input type="text" name="" id="" maxlength="1">
                    <input type="text" name="" id="" maxlength="1">
                    <input type="text" name="" id="" maxlength="1">
                    <input type="text" name="" id="" maxlength="1">
                    <input type="text" name="" id="" maxlength="1">
                </div>
                <button type="submit" id="button" disabled>Verify</button>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="otphandler.js"></script>
        <script>
            var email = "<?php echo $_SESSION['regEmail'];?>";
            email = "*" + "*"+"*" + "*"+email.slice(2);
            document.getElementById('showMail').innerHTML = email;
            // console.log(email);
        </script>
</body>
</html>