<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/navbar.css?v=<?php echo time(); ?>">
    <script>
        nu2301

        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>
</head>

<body>
    <?php
    include '../database/dbconnect.php';
    session_start();
    $id = $_SESSION['id'];
    $is_admin = $_SESSION['is_admin'];
    if ($id) {
        if ($_SESSION['is_admin'] == '1') {
            $countsql = "SELECT COUNT(is_verify) AS count FROM pdf WHERE is_verify = 0";
        } else {
            $countsql = "SELECT COUNT(is_verify) AS count FROM pdf WHERE is_verify = 0 AND id = $id";   
        }
        $res1 = mysqli_query($conn, $countsql);
        $nums = mysqli_num_rows($res1);
        if ($res1) {
            $row = mysqli_fetch_assoc($res1);
            // echo $id;
            $count = $row['count'];
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    ?>
    <nav>

        <p>
            <a href="../pages/display.php">HOME Page</a>

        </p>

        <p class="left">
            <a href="../login/logout.php" onclick="return confirmLogout();">Log out</a>
        </p>
        <p class="left">
            <a href="../crud/addpdf.php">Add pdf</a>
        </p>
        <?php
            if ($is_admin == '1') {
        ?>
                <p class="left">
                    <a href="../admin/adminverify.php">Pdf Verification<sup><?php echo $count ?></sup></a>
                </p>

            <?php
            } else {

            ?>
                <p class="left">
                    <a href="../verification/verify.php">Pdf verification<sup><?php echo $count ?></sup></a>
                </p>
            <?php
            }

            if ($is_admin == NULL) {
            ?>
                <a href="../profile/profile.php">Profile</a>
            <?php
            } else if ($is_admin == '1' || $is_admin == '0') {
            ?>
                <a href="../profile/adminprofile.php">Profile</a>

        <?php
            }
        // }

        ?>

    </nav>
</body>

</html>