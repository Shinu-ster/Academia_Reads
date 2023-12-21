<?php
include '../database/dbconnect.php';
session_start();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $profile = $_SESSION['id'];
    // Allow to use this page only if the session exists
} else {
    header('location:http://localhost/4thsemProj/login/login.php');
    exit; // Add exit after the header to stop script execution
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
    <?php include_once '../components/navbar.php'; ?>

    <?php
    $sql = "SELECT * FROM pdf WHERE id = $profile AND is_verify = 0";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    ?>

    <?php if ($num == 0) : ?>
        <p>You haven't posted any PDFs.</p>
    <?php else : ?>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Cover</th>
                <th>Status</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td id="description"><?php echo $row['description']; ?></td>
                    <td><img src="<?php echo $row['cover']; ?>" alt="" height="20px" width="20px"></td>
                    <td>
                        <?php
                        $status = $row['is_verify'];
                        echo $status == 0 ? 'Pending..' : ($status == 1 ? 'Approved' : 'Unknown');
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
</body>

</html>
