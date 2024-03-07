<?php
include '../database/dbconnect.php';
session_start();
$profile = $_SESSION['id'];
$is_admin = $_SESSION['is_admin'];
$semester = $_SESSION['sem'];
if ($profile == true) {
    //allow to use this page only if session exists
    // echo "session exists";
} else {
    header('location:http://localhost/4thsemProj/login/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this pdf?");
        }
    </script>
    <link rel="stylesheet" href="../styles/display.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">


</head>

<body>
    <?php
    include_once '../components/navbar.php';
    ?>
    <div class="container">
        <?php
        if ($semester) {
            $sql = "SELECT * FROM pdf WHERE is_verify = '1' and semester = $semester";
        }else{
            $sql = "SELECT * FROM pdf WHERE is_verify = '1'";
        }
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {;

        ?>
                <div class="wrapper">
                    <div class="image">
                        <a href="../crud/view.php?view='<?php echo $row['f_id']; ?>'">
                            <img src="<?php echo $row['cover'] ?>" alt="" srcset="" height="100px">
                        </a>
                    </div>
                    <div class="title">
                        <p>
                            <?php
                            echo $row['name'];
                            ?>
                        </p>
                    </div>
                    <div class="description">
                        <?php
                        echo $row['description'];
                        ?>
                        <br>
                        <p>Added by: <?php
                                        $id = $row['id'];
                                        $sql1 = "SELECT * from user where id = $id";
                                        $result1 = mysqli_query($conn, $sql1);
                                        $row1 = mysqli_fetch_assoc($result1);
                                        echo $row1['username'];
                                        ?></p>
                    </div>
                    <?php
                    if (
                        $profile == $id || $profile == '5'
                    ) {
                        if ($is_admin != NULL) {

                    ?>
                            <div class="buttons">
                                <a href="../crud/edit.php?edit='<?php
                                                                echo $row['f_id'];
                                                                ?>'">
                                    <button class="primary">
                                        Edit
                                    </button>
                                </a>
                                <a href="../crud/delete.php?delete_key='
                        <?php echo $row['f_id']; ?>
                        '" onclick=" return confirmDelete();">
                                    <button class="danger">
                                        Delete
                                    </button>
                                </a>
                            </div>
                    <?php
                        }
                    } else {
                    }
                    ?>

                </div>



        <?php
            }
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            echo $search;
            $_SESSION['search'] = $search;

            // echo $search;
            header('location:http://localhost/4thsemProj/pages/search.php');
        }

        ?>


    </div>

</body>

</html>