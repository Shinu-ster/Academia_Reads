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

    <?php
    $sql = "SELECT * FROM pdf where f_id = $pdfid";
    // echo $pdfid;
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    // echo $num;
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <div class="container">
                <h1>
                    <?php
                    echo $row['name'];
                    ?>
                </h1>
                <a href="../pages/read.php?show='<?php echo $row['f_id']; ?>'">
                    <img src="<?php echo $row['cover'] ?>" alt="" srcset="" width="500px">
                    <p>Click here to read</p>
                </a>
                <table border="1">
                    <tr>
                        <th>Added By:</th>
                        <td><?php echo $row['name'] ?></td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td><?php echo $row['description'] ?></td>
                    </tr>
                    <tr>
                        <th>Genre:</th>
                        <td><?php echo $row['genre'] ?></td>
                    </tr>
                </table>
                <div class="comment">
                    <form action="" method="post">
                        <textarea name="" id="" cols="30" rows="10" placeholder="Add Comment"></textarea>
                        <Button>Submit</Button>
                    </form>
                </div>
            </div>
    <?php

        }
    } ?>
</body>

</html>