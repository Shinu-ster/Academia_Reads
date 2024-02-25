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
</head>

<body>
    <?php
    include_once '../components/navbar.php'; ?>

    <?php
    $date = date('Y-m-d H:i:s');
    echo $date;
    $sql = "SELECT * FROM pdf where is_verify = 0";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    ?>
    <?php
    if ($num == 0) :
    ?>
        <p>No PDFs to Approve yet</p>
    <?php else : ?>
        <table border=1>
            <tr>

                <th>Name</th>
                <th>Description</th>
                <th>Cover</th>
                <th>Verify</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) :
            ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="<?php echo $row['file'] ?>"><img src="<?php echo $row['cover']; ?>" alt="" srcset="" height="20px" width="20px"></a>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="pdf_id" value="<?php echo $row['f_id']; ?>">
                            <input type="submit" value="Approve" name="approve" onclick="return approvepdf($row['f_id']);">
                            <input type="submit" value="Decline" name="">
                        </form>
                    </td>
                </tr>
            <?php
            endwhile;
            ?>

        </table>
    <?php
    endif;
    ?>

    <?php
    if (isset($_POST['approve'])) {

        if (isset($_POST['pdf_id'])) {
            $pdf_id = $_POST['pdf_id'];
            $approvesql = "UPDATE pdf SET is_verify= '1', verified_date = CURRENT_TIMESTAMP WHERE f_id = $pdf_id";
            $approveres = mysqli_query($conn, $approvesql);
            if ($res) {
                echo 'Approved pdf';
            }
        } else {
            echo "Error: PDF ID not set.";
        }
    }
    ?>
</body>

</html>