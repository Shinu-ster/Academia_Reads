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
    <link rel="stylesheet" href="../styles/home.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include_once '../components/navbar.php';
    ?>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        Name:
                    </td>
                    <td>
                        <input type="text" name="name" id="" required value="<?php echo $row1['name']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Description:
                    </td>
                    <td>
                        <textarea name="desc" id="" cols="30" required rows="10">
                            <?php
                            if ($f_id == true) {
                                echo $row1['description'];
                            } else {
                                echo "Add Description";
                            }
                            ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        File:
                    </td>
                    <td>
                        <input type="file" name="file" id="" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Cover Photo:
                    </td>
                    <td>
                        <input type="file" name="cover" id="" required>
                    </td>
                </tr>
            </table>
            <button type="submit" name="submit">Submit</button>
        </form>
        <?php

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $desc = mysqli_real_escape_string($conn, $_POST['desc']);
            $file = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $folder = '../pdfs/' . $file;
            if (move_uploaded_file($temp, $folder)) {
                // echo "file moved";
            } else {
                echo "file not moved in pdf";
            }
            $cover = $_FILES['cover']['name'];
            $tempcover = $_FILES['cover']['tmp_name'];
            $foldercover =  '../cover/' . $cover;

            if (move_uploaded_file($tempcover, $foldercover)) {
                // echo "file moved";
            } else {
                echo "file not moved in cover";
            }
            echo $profile;
            $is_verify = "0";
            $sql = "INSERT INTO pdf (name,description,file,cover,id,is_verify) VALUES ('$name','$desc','$folder','$foldercover','$profile','$is_verify')";

            $res = mysqli_query($conn, $sql);
            if ($res) {
                header('location:http://localhost/4thsemProj/pages/display.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
        ?>
    </div>
</body>

</html>