<?php
include '../database/dbconnect.php';
$reg_no = $_GET['id'];
session_start();
$usertype = $_SESSION['is_admin'];
if ($usertype != '1') {
    header('Location:http://localhost/4thsemProj/pages/display.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/table.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <?php
    include_once '../components/navbar.php';
    ?>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>
                Semsester
            </th>
            <th>
                Registration Number
            </th>
            <th>
                Username
            </th>
        </tr>
        <tr>
            <?php
            $selectSQL = "SELECT * FROM student where reg_no = '$reg_no'";
            $response = mysqli_query($conn, $selectSQL);
            if (mysqli_num_rows($response) > 0) {
                while ($fetch = mysqli_fetch_assoc($response)) {
            ?>
                    <td>
                        <?php echo $fetch['name'] ?>
                    </td>
                    <td>
                        <?php echo $fetch['semester'] ?>
                    </td>
                    <td>
                        <?php echo $fetch['reg_no'] ?>
                    </td>
                    <td>
                        <?php echo $fetch['username'] ?>
                    </td>
            <?php
                }
            }
            ?>
        </tr>
    </table>


</body>

</html>