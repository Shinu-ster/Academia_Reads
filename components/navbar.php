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

    <a href="../pages/display.php">
        <div>
            Academia Reads
        </div>
    </a>
    <?php
    if (!isset($_SESSION['is_admin'])) {
        //Is Student
    } else {
        // Is admin
    ?>
        <a href="http://localhost/4thsemProj/crud/addpdf.php">
            <div class="left">
                Add pdf
            </div>
        </a>
    <?php
    }
    ?>
    <?php
    if (isset($_SESSION['is_admin'])) {

        if ($is_admin == '1') {
    ?>
            <a href="../admin/adminverify.php">
                <div class="count">
                    Verification<sup><?php echo $count ?></sup>
                </div>
            </a>

        <?php
        } else {

        ?>
            <a href="../verification/verify.php">
                <div class="count">
                    Verification<sup><?php echo $count ?></sup>
                </div>
            </a>
        <?php
        }
    }
    if ($is_admin == NULL) {
        ?>
        <a href="../profile/profile.php">
            <div>
                Profile
            </div>
        </a>
    <?php
    } else if ($is_admin == '1' || $is_admin == '0') {
    ?>
        <a href="../profile/adminprofile.php">
            <div>Profile</div>
        </a>
    <?php
    }
    ?>
    <a href="../login/logout.php" onclick="return confirmLogout();">
        <div class="left">
            Log out
        </div>
    </a>
</nav>