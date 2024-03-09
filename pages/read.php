<?php
include '../database/dbconnect.php';
session_start();
$profile = $_SESSION['id'];
$readid = $_GET['show'];
if ($profile == true) {
    //allow to use this page only if session exists
    // echo "session exists";
} else {
    header('location:http://localhost/4thsemProj/authentication/login.php');
}
$getlocation = "SELECT * FROM pdf where f_id = $readid";
$res = mysqli_query($conn, $getlocation);
$num = mysqli_num_rows($res);
if ($num == 1) {
    while (
        $data = mysqli_fetch_assoc($res)
    ) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
            <title>Document</title>
            <!-- <?php
            include_once '../components/navbar.php';
            ?> -->
            <style>
                embed {
                    height: 1000px;
                }
            </style>
        </head>

        <body>
            <embed src="<?php echo $data['file']; ?>" type="application/pdf" width="100%">
    <?php
    }
}
    ?>
        </body>

        </html>