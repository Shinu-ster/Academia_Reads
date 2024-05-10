<?php
include '../database/dbconnect.php';
session_start();
$profile = $_SESSION['id'];
$pdfid = $_GET['view'];
if ($profile == true) {
    // Allow to use this page only if session exists
    // echo "session exists";
} else {
    header('location:http://localhost/4thsemProj/authentication/login.php');
    exit(); // Add an exit to stop further execution
}

$isadmin = $_SESSION['is_admin'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/view.css?v=<?php echo time(); ?>">
    <!-- <link rel="stylesheet" href="../styles/table.css?v=<?php echo time(); ?>"> -->

    <title>Document</title>
    <?php
    include_once '../components/navbar.php';
    ?>
    <script>
        function checkVerification() {
            var session = <?php echo $_SESSION['is_verified']; ?>;
            if (session === 0) {
                alert('Your account is not verified. Visit the profile page to verify your account.');
                return false; // Prevent the link from being followed
            }
            return true; // Allow the link to be followed if the account is verified
        }
    </script>

</head>

<body>
    <?php
    $sql = "SELECT * FROM pdf where f_id = $pdfid";
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
                <div class="flex-box">
                    <a href="../pages/read.php?show='<?php echo $row['f_id']; ?>'" onclick=" return checkVerification();">
                        <img src="<?php echo $row['cover'] ?>" alt="" srcset="" width="500px">
                        <p>Click here to read</p>
                    </a>
                    <table border="1">
                        <tr>
                            <th>Title:</th>
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
                </div>
                <div class="commentbox">
                    <form action="" method="post">
                        <textarea id="" cols="30" rows="10" class="commentbox" placeholder="Add Comment" name="comment"></textarea>
                        <Button type="submit" name="submit">Submit</Button>
                    </form>
                </div>
                <?php
                $getcomments = "SELECT CASE 
                WHEN rc.cm_by IS NOT NULL THEN s.name
                WHEN rc.cm_by_admin IS NOT NULL THEN u.name
                END AS commenter_name,
                rc.comment, r.name
                FROM resource_comment rc 
                INNER JOIN pdf r ON r.f_id = rc.r_id
                LEFT JOIN student s ON s.stu_id = rc.cm_by
                LEFT JOIN user u ON u.id = rc.cm_by_admin
                WHERE r_id = $pdfid AND rc.is_verified = 1";
                $result = mysqli_query($conn, $getcomments);
                $num = mysqli_num_rows($result);
                if ($num > 0) :
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="comment">
                            <?php
                            echo $row['comment'] . '</br>';
                            echo $row['commenter_name'] . '</br>';
                            ?>
                        </div>
                <?php
                    }
                endif;
                ?>
            </div>
    <?php
        }
    }

    // Determine which column to use based on user role
    $cm_column = ($isadmin === NULL) ? 'cm_by' : 'cm_by_admin';
    if ($cm_column == 'cm_by') {
        if ($_SESSION['is_verified'] == '1') {
            $verified = '1';
        } else {
            $verified = '0';
        }
    } else if ($cm_column == 'cm_by_admin'){
            $verified = '1';
        
    }
    session_start();
    if (isset($_POST['submit'])) {
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $commentsql = "INSERT INTO resource_comment(r_id, comment, cm_date,is_verified, $cm_column) VALUES ($pdfid, '$comment', CURRENT_TIMESTAMP,$verified, $profile)";
        $result = mysqli_query($conn, $commentsql);
        if ($result) {
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
</body>

</html>