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
    $sql = "SELECT * FROM pdf WHERE id = $profile ";
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
                <th>Feedback</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <?php $resourceid = $row['f_id'] ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td id="description"><?php echo $row['description']; ?></td>
                    <td>
                        <a href="../pages/read.php?show='<?php echo $resourceid ?>'">
                            <img src="<?php echo $row['cover']; ?>" alt="" height="20px" width="20px">
                        </a>
                    </td>
                    <td>
                        <?php
                        $status = $row['is_verify'];
                        echo $status == 0 ? 'Pending..' : ($status == 1 ? 'Approved' : 'Unknown');
                        ?>
                    </td>
                    <td>
                        <?php
                        $checkmsg = "SELECT * FROM resource_feedback where r_id = $resourceid";
                        $res = mysqli_query($conn, $checkmsg);
                        $num = mysqli_num_rows($res);
                        if ($num > 0) {
                            //if exists create session and 
                            //redirect to home page
                            $data = mysqli_fetch_assoc($res);
                            $message = $data['feedback'];
                            echo $message .'</br>';
                            echo '<a href="../crud/edit.php?edit='.$row['f_id'].'"">ReUpload</a>';
                        } else {
                            echo "No messages";
                        }
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
</body>

</html>