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
    <link rel="stylesheet" href="../styles/table.css?v=<?php echo time(); ?>">

    <?php
    include_once '../components/navbar.php' ?>
</head>

<body>
    <?php
    $joinsql = "SELECT CASE 
    when rc.cm_by is not null then s.name
    when rc.cm_by_admin is not null then u.name
    end as commenter_name,
    rc.comment,
    r.name,rc.r_id
    from resource_comment rc 
    inner join 
    pdf r on r.f_id = rc.r_id
    left join 
    student s on s.stu_id = rc.cm_by
    left join 
    user u on u.id = rc.cm_by_admin
    where rc.is_verified = 0";
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
            ?><tr>
                    <td><?php echo $row['comment']; ?></td>
                    <td><?php echo $row['commenter_name']; ?></td> <!-- Change 'username' to 'commenter_name' -->
                    <td><?php echo $row['name']; ?></td> <!-- Assuming 'name' corresponds to the commented resource -->
                    <td>
                        <form method="POST">
                            <button type="submit" name="approve" value="<?php echo $row['r_id']; ?>">Approve</button>
                            <button type="submit" name="deny" value="<?php echo $row['r_id']; ?>">Deny</button>
                        </form>

                    </td>
                </tr>
        <?php
            endwhile;
        }
        if (isset($_POST['approve'])) {
            $id = $_POST['approve'];
            $approvesql = "UPDATE resource_comment set is_verified = 1 where r_id = $id";
            $approveres = mysqli_query($conn, $approvesql);
            if ($res) {
                echo 'Approved Comment';
            }
        } else {
            // echo "Error: PDF ID not set.";
        }

        if (isset($_POST['deny'])) {
            $id = $_POST['deny'];
            $denysql = "UPDATE resource_comment set is_verified = 0 where r_id = $id";
            $approveres = mysqli_query($conn, $denysql);
            if ($res) {
                echo 'Denied Comment';
            }
        } else {
            // echo "Error: PDF ID not set.";
        }
        ?>
        </table>
        <?php

        ?>
</body>

</html>