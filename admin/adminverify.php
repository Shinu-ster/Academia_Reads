<?php

include '../database/dbconnect.php';
session_start();
if ($_SESSION['is_admin'] = 5 && isset($_SESSION['id'])) {
    // echo $_SESSION['is_admin'];
} else {
    header('location:http://localhost/4thsemProj/crud/addpdf.php');
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
    <table border=1>
        <tr>

            <th>Name</th>
            <th>Description</th>
            <th>Cover</th>
            <th>Verify</th>
        </tr>

        <?php
        $sql = "SELECT * FROM pdf where is_verify = 0";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <img src="<?php echo $row['cover']; ?>" alt="" srcset="" height="20px" width="20px">
                    </td>
                    <td>
                        <button>Approve</button>
                        <button>Decline</button>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</body>

</html>