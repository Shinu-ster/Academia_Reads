<?php
include '../database/dbconnect.php';
session_start();
if ($_SESSION['is_admin'] == 1) {
} else {
    header('location:http://localhost/4thsemProj/pages/display.php');
    // echo "Invalid access";
    // exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
    <?php
    include_once '../components/navbar.php' ?>
</head>

<body>
    <?php
    $joinsql = "SELECT * FROM resource_comment as rc inner join student on student.stu_id = rc.cm_by inner join pdf on pdf.f_id = rc.r_id, where rc.is_verified = 0";
    $result = mysqli_query($conn, $joinsql);
    $num = mysqli_num_rows($result);
    ?>
    <?php
    if ($num == 0) :
    ?>
        <p>No PDFs to Approve yet</p>
    <?php else : ?>
        <table border=1>
            <tr>

                <th>Comment</th>
                <th>Commented by</th>
                <th>Commented at</th>
                <th>Status</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) :
            ?>
                <tr>
                    <td><?php echo $row['comment']; ?></td>
                    <td><?php echo $row['username'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td>
                        <form method="POST">
                            <button type="submit" name="approve" value=<?php echo $row['r_id'] ?>>Approve</button>
                            <button type="submit" name="deny" value=<?php echo $row['r_id'] ?>>Deny</button>
                        </form>
                    </td>
                </tr>
            <?php
            endwhile;
            if (isset($_POST['approve'])) {
                $id = $_POST['approve'];
                $approvesql = "UPDATE resource_comment set is_verified = 1 where r_id = $id";
                $res = mysqli_query($conn, $approvesql);
                if ($res) {
                    echo "done";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }

            if (isset($_POST['deny'])) {
                $id = $_POST['deny'];
                $denysql = "UPDATE resource_comment set is_verified = 0 where r_id = $id";
                $res = mysqli_query($conn, $denysql);
                if ($res) {
                    echo "done";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
            ?>
        </table>
    <?php
    endif;
    ?>
</body>

</html>