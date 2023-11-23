<?php
include '../database/dbconnect.php';
session_start();
    $f_id = $_GET['edit'];
    $sql1 = "SELECT * FROM pdf WHERE f_id = $f_id";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($result1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/edit.css?v=<?php echo time(); ?>">
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
                <img  name="cover" id="" src="
                    <?php
                        echo $row1['cover'];
                    ?>"
                    width="220px" height="220px"
                    >
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
                        Name
                    </td>
                    <td>
                        <input type="text" name="" id="">
                    </td>
                </tr>
                <tr>
                    <td>
                        Description
                    </td>
                    <td>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>New Upload</td>
                    <td>
                        <input type="file" name="" id="">
                    </td>
                </tr>
                <tr>
                    <td>
                        New Cover 
                    </td>
                    <td>
                        <input type="file" name="" id="">
                    </td>
                </tr>
            </table>
            <button type="submit" name="submit">Submit Changes</button>
            </form>
        </div>
    </div>
   
   
</body>
</html>

</html>