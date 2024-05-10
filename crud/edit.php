<?php
include '../database/dbconnect.php';
session_start();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $profile = $_SESSION['id'];
    // Allow to use this page only if the session exists
} else {
    header('location:http://localhost/4thsemProj/authentication/login.php');
    exit; // Add exit after the header to stop script execution
}
$f_id = $_GET['edit'];
$accessID = "SELECT id from pdf where f_id = $f_id";
$res = mysqli_query($conn, $accessID);
$row = mysqli_fetch_assoc($res);
$uploaderid = $row['id'];

if ($uploaderid == $profile || $_SESSION['is_admin'] == 1) {
    // Allow to use this page
    $sql1 = "SELECT * FROM pdf WHERE f_id = $f_id";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
} else {
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
    <link rel="stylesheet" href="../styles/edit.css?v=<?php echo time(); ?>">
    <script>
        function showMsg() {
            alert('Updated Succesfully. Redirecting...')

        }
    </script>
</head>

<body>
    <?php
    include_once '../components/navbar.php';
    ?>
    <div class="container">

        <div class="prev">
            <table>
                <caption>Old File</caption>
                <tr>
                    <td>
                        Name:
                    </td>
                    <td>
                        <p>
                            <?php
                            echo $row1['name'];
                            ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        Description:
                    </td>
                    <td>
                        <p>
                            <?php
                            echo $row1['description'];
                            ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        Previous File:
                    </td>
                    <td>
                        <embed src="<?php
                                    echo $row1['file'];
                                    ?>" type="application/pdf" width="220px" height="220px" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Previous Cover Photo:
                    </td>
                    <td>
                        <img name="cover" id="" src="
                    <?php
                    echo $row1['cover'];
                    ?>" width="220px" height="220px">
                    </td>
                </tr>
            </table>
        </div>
        <div class="new">
            <form action="" method="post" enctype="multipart/form-data">

                <table>
                    <caption>New file</caption>
                    <tr>
                        <td>
                            Name:
                        </td>
                        <td>
                            <input type="text" name="newName" id="" value='<?php echo $row1['name'] ?>'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Description:
                        </td>
                        <td>
                            <textarea name="newDesc" id="" cols="30" rows="10"><?php echo $row1['description'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>PDF:</td>
                        <td>
                            <input type="file" name="newPdf" id="" accept=".doc,.docx,application/pdf">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            New Cover:
                        </td>
                        <td>
                            <input type="file" name="newCover" id="" accept="image/*">
                        </td>
                    </tr>
                </table>
                <p style="color:red">No need to insert another file if you just want to update the name of description only*</p>
                <button type="submit" name="submit">Submit Changes</button>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['newName'];
        $desc = mysqli_real_escape_string($conn, $_POST['newDesc']);

        $file = $_FILES['newPdf']['name'];
        if ($file == NULL) {
            $file = $row1['file'];
        } else {
            // Remove old file
            $pdfFilePath = $row1['file'];
            if (file_exists($pdfFilePath)) {
                unlink($pdfFilePath);
            }
        }
        $temp = $_FILES['newPdf']['tmp_name'];
        $folder = '../pdfs/' . $file;
        if (move_uploaded_file($temp, $folder)) {
            // echo "file moved";
        } else {
            echo "file not moved in pdf";
        }
        $cover = $_FILES['newCover']['name'];
        if ($cover == NULL) {
            $cover = $row1['cover'];
        } else {
            // Remove old cover
            $coverFilePath = $row1['cover'];
            if (file_exists($coverFilePath)) {
                unlink($coverFilePath);
            }
        }
        $tempcover = $_FILES['newCover']['tmp_name'];
        $foldercover =  '../cover/' . $cover;

        if (move_uploaded_file($tempcover, $foldercover)) {
            // echo "file moved";
        } else {
            echo "file not moved in cover";
        }
        if ($_SESSION['is_admin'] == 1) {
            $adminUpdateQuery = "UPDATE `pdf` SET `name`='$name', `description`='$desc', `file`='$folder', `cover`='$foldercover' WHERE `f_id` = $f_id";
            $result = mysqli_query($conn, $adminUpdateQuery);
            if ($result) {
                echo '<script>showMsg(); window.location.href = "http://localhost/4thsemProj/pages/display.php";</script>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            $updatequery = "UPDATE `pdf` SET `name`='$name', `description`='$desc', `file`='$folder', `cover`='$foldercover', `update_date` = CURRENT_TIMESTAMP WHERE `f_id` = $f_id AND `id` = $profile";
            $result = mysqli_query($conn, $updatequery);
            if ($result) {
                echo '<script>showMsg(); window.location.href = "http://localhost/4thsemProj/pages/display.php";</script>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    ?>

</body>

</html>

</html>