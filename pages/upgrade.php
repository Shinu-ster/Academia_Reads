<?php
include '../database/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <?php
    include_once '../components/navbar.php';
    ?>
    <table border="1">
        <tr>
            <th>First Semester</th>
            <th>Second Semester</th>
            <th>Third Semester</th>
            <th>Fourth Semester</th>
            <th>Fifth Semester</th>
            <th>Sixth Semester</th>
            <th>Seventh Semester</th>
            <th>Eighth Semsester</th>
        </tr>
        <tr>
            <form method="POST">
                <td><?php
                    $firstSemsql = "SELECT * FROM student where semester = 1";
                    $res = mysqli_query($conn, $firstSemsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $firstid = $row['semester'];
                            echo $row['name'];
                            echo '</br>';
                        }
                    }
                    ?>
                    <br>
                    <button type="submit" name="upgrade" value="<?php echo $firstid ?>">Upgrade Semester</button>
                </td>
                <td>
                    <?php
                    $secondsql = "SELECT * FROM student where semester = 2";
                    $res = mysqli_query($conn, $secondsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $secondid = $row['semester'];
                            echo $row['name'];
                            echo '</br>';
                        }
                    }
                    ?>
                    <button type="submit" name="upgrade" value="<?php echo $secondid ?>">Upgrade Semester</button>
                </td>
                <td>
                    <?php
                    $thirdsql = "SELECT * FROM student where semester = 3";
                    $res = mysqli_query($conn, $thirdsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $thirdid = $row['semester'];
                            echo $row['name'];
                            echo '</br>';
                        }
                    }
                    ?><button type="submit" name="upgrade" value="<?php echo $thirdid ?>">Upgrade Semester</button>
                </td>
                <td>
                    <?php
                    $fourthsql = "SELECT * FROM student where semester = 4";
                    $res = mysqli_query($conn, $fourthsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $fourthid = $row['semester'];
                            echo $row['name'];
                            echo '</br>';
                        }
                    }
                    ?><button type="submit" name="upgrade" value="<?php echo $fourthid ?>">Upgrade Semester</button>
                </td>
                <td>
                    <?php
                    $fifthsql = "SELECT * FROM student where semester = 5";
                    $res = mysqli_query($conn, $fifthsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $fifthid = $row['semester'];
                            echo $row['name'];
                            echo '</br>';
                        }
                    }
                    ?><button type="submit" name="upgrade" value="<?php echo $fifthid ?>">Upgrade Semester</button>
                </td>
                <td>
                    <?php
                    $sixthsql = "SELECT * FROM student where semester = 6";
                    $res = mysqli_query($conn, $sixthsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $sixthid = $row['semester'];
                            echo $row['name'];
                            echo '</br>';
                        }
                    }
                    ?>
                    <button type="submit" name="upgrade" value="<?php echo $sixthid ?>">Upgrade Semester</button>
                </td>
                <td>
                    <?php
                    $seventhsql = "SELECT * FROM student where semester = 7";
                    $res = mysqli_query($conn, $seventhsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $seventhid = $row['semester'];
                            echo $row['name'];
                            echo '</br>';
                        }
                    }
                    ?><button type="submit" name="upgrade" value="<?php echo $seventhid ?>">Upgrade Semester</button>
                </td>
                <td>
                    <?php
                    $eightsql = "SELECT * FROM student where semester = 8";
                    $res = mysqli_query($conn, $eightsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $eightid = $row['semester'];
                            echo $row['name'];
                            echo '</br>';
                        }
                    }
                    ?><button type="submit" name="upgrade" value="<?php echo $eightid ?>">Upgrade Semester</button>
                </td>
            </form>
        </tr>
    </table>
    <?php
    if (isset($_POST['upgrade'])) {
        $id = $_POST['upgrade'];
        echo $id + 1;
        $upgradesemester = "UPDATE student set semester = $id + 1 where semester = $id";
        $response = mysqli_query($conn,$upgradesemester);
        if ($response) {
            echo "done";
        }else{
            echo "Something is wrong";
        }
    }
    ?>
</body>

</html>