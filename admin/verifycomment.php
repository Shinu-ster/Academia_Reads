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
    $joinsql = "SELECT * FROM resource_comment as rc inner join student on student.stu_id = rc.cm_by inner join pdf on pdf.f_id = rc.r_id where rc.is_verified = 0";
    // $sql = "SELECT * FROM resource_comment where is_verified = 0";
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
                    <td><button>Approve</button>
                        <button>Deny</button>
                    </td>
                </tr>
            <?php
            endwhile;
            ?>
        </table>
    <?php
    endif;
    ?>
</body>

</html>