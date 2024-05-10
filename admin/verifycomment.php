<?php
include '../database/dbconnect.php';
session_start();
if ($_SESSION['is_admin'] != 1) {
    header('location:http://localhost/4thsemProj/pages/display.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/table.css?v=<?php echo time(); ?>">

    <?php include_once '../components/navbar.php'; ?>
</head>

<body>
    <?php
    $joinsql = "SELECT CASE 
        WHEN rc.cm_by IS NOT NULL THEN s.name
        WHEN rc.cm_by_admin IS NOT NULL THEN u.name
        END AS commenter_name,
        rc.comment,
        r.name,
        rc.r_id
    FROM resource_comment rc 
    INNER JOIN pdf r ON r.f_id = rc.r_id
    LEFT JOIN student s ON s.stu_id = rc.cm_by
    LEFT JOIN user u ON u.id = rc.cm_by_admin
    WHERE rc.is_verified = 0";
    $result = mysqli_query($conn, $joinsql);
    $num = mysqli_num_rows($result);
    if ($num == 0) {
    ?>
        <p>There are no comments to verify</p>
    <?php
    } else {
    ?>
        <table border="1">
            <tr>
                <th>Comment</th>
                <th>Commenter name</th>
                <th>Resource name</th>
                <th>Status</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) :
                $comment = $row['comment'];
                $commenter = $row['commenter_name'];
                $name = $row['name'];
                $r_id = $row['r_id'];
            ?>
                <tr>
                    <td><?php echo $comment; ?></td>
                    <td><?php echo $commenter; ?></td>
                    <td><?php echo $name; ?></td>
                    <td>
                        <form method="POST">
                            <button type="submit" name="approve_<?php echo $r_id; ?>" value="<?php echo $r_id; ?>">Approve</button>
                            <button type="submit" name="deny_<?php echo $r_id; ?>" value="<?php echo $r_id; ?>">Deny</button>
                        </form>
                    </td>
                </tr>
            <?php
            endwhile;
        }

        // Process approval or denial based on the specific comment's r_id
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'approve_') !== false) {
                $id = substr($key, strlen('approve_'));
                $approvesql = "UPDATE resource_comment SET is_verified = 1 WHERE r_id = $id AND is_verified = 0";
                $approveres = mysqli_query($conn, $approvesql);
                if ($approveres) {
                    echo 'Approved Comment';
                    header("Refresh:0"); // Refresh the page after successful approval
                } else {
                    echo 'Error approving comment: ' . mysqli_error($conn);
                }
            }

            if (strpos($key, 'deny_') !== false) {
                $id = substr($key, strlen('deny_'));
                $denysql = "DELETE FROM resource_comment WHERE r_id = $id AND is_verified = 0";
                $denyres = mysqli_query($conn, $denysql);
                if ($denyres) {
                    echo 'Denied Comment';
                    header("Refresh:0"); // Refresh the page after successful denial
                } else {
                    echo 'Error denying comment: ' . mysqli_error($conn);
                }
            }
        }
        ?>
        </table>
</body>

</html>
