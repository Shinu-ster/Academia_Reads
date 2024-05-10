    <link rel="stylesheet" href="../styles/navbar.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>



    <?php
    include '../database/dbconnect.php';
    session_start();
    $id = $_SESSION['id'];
    $is_admin = $_SESSION['is_admin'];
    if ($id) {
        if ($_SESSION['is_admin'] == '1') {
            $countsql = "SELECT COUNT(is_verify) AS count FROM pdf WHERE is_verify = 0";
            $commentcount = "SELECT COUNT(is_verified) as count FROM resource_comment WHERE is_verified = 0";
        } else {
            $countsql = "SELECT COUNT(is_verify) AS count FROM pdf WHERE is_verify = 0 AND id = $id";
        }
        $res1 = mysqli_query($conn, $countsql);
        if ($res1) {
            $row = mysqli_fetch_assoc($res1);
            $count = $row['count'];
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Move this part inside the if condition
        if ($is_admin == '1') {
            $res2 = mysqli_query($conn, $commentcount);
            if ($res2) {
                $row = mysqli_fetch_assoc($res2);
                $countcmt = $row['count'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

    ?>
   <nav>
    <ul>
        <li><a href="../pages/display.php">Academia Reads</a></li>
        <?php if (!isset($_SESSION['is_admin'])): ?>
            <!-- Is Student -->
        <?php else: ?>
            <!-- Is admin -->
            <li><a href="http://localhost/4thsemProj/crud/addpdf.php">Add pdf</a></li>
            <?php if ($is_admin == '1'): ?>
                <li><a href="../admin/adminverify.php">Verification<sup><?php echo $count ?></sup></a></li>
                <!-- <li><a href="../admin/verifycomment.php">Comments Verify<sup><?php echo $countcmt ?></sup></a></li>pp -->
                <li><a href="../pages/upgrade.php">Upgrade Students</a></li>
            <?php else: ?>
                <li><a href="../verification/verify.php">Verification<sup><?php echo $count ?></sup></a></li>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($is_admin == NULL || $is_admin == '1' || $is_admin == '0'): ?>
            <li><a href="<?php echo ($is_admin == NULL) ? '../profile/profile.php' : '../profile/adminprofile.php'; ?>">Profile</a></li>
        <?php endif; ?>
        <li><a href="../authentication/logout.php" onclick="return confirmLogout();">Log out</a></li>
    </ul>
    <div id="searchbox">
        <input type="search" name="" id="searchBox">
    </div>
</nav>
