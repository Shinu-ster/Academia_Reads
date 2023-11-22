<?php
    include '../database/dbconnect.php';
    session_start();
    $profile = $_SESSION['id'];
    $pdfid = $_GET['view'];
    if($profile == true){
        //allow to use this page only if session exists
        // echo "session exists";
    }else{
        header('location:http://localhost/4thsemProj/login/login.php');
    }
    
    $sql = "SELECT * FROM pdf where f_id = $pdfid";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo $row['name'];
    
    ?>
<embed src="<?php
    echo $row['file'];
?>" type="application/pdf" width="1260px" height="600px" />
</body>
</html>