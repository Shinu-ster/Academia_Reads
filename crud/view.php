<?php
include '../database/dbconnect.php';
session_start();
$profile = $_SESSION['id'];
$pdfid = $_GET['view'];
if ($profile == true) {
    //allow to use this page only if session exists
    // echo "session exists";
} else {
    header('location:http://localhost/4thsemProj/login/login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/view.css?v=<?php echo time(); ?>">

    <title>Document</title>
    <?php
    include_once '../components/navbar.php';
    ?>
</head>

<body>
    <div class="container">
        <?php
        $sql = "SELECT * FROM pdf where f_id = $pdfid";
        echo $pdfid;
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        echo $num;
        if ($num == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <table border="1">
                    <p>hello</p>
                    <tr>
                        <td>

                            <?php
                            echo $row['name'];
                            ?>
                        </td>
                        <td>hello//</td>
                    </tr>
                </table>
    </div>
<?php

            }
        } ?>
<p>htmlspecialchars_decode</p>
</body>

</html>