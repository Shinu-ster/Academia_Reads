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
    header('location:http://localhost/4thsemProj/authentication/login.php');
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
    <script>
        function approvalConfirm() {
            return confirm("Are you sure you want to approve");
        }

        function denyConfirm() {
            return confirm("Are you sure you want to deny");
        }
    </script>
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
                <td>

                    <?php
                    $firstsql = "SELECT * FROM student where semester = 1";
                    $res = mysqli_query($conn, $firstsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $firstid = $row['semester'];
                            $stu_id = $row['stu_id'];
                            $currentsem = $row['semester']; ?>
                            <input type="checkbox" name="upgradeStudent[]" value="<?php echo $stu_id; ?>">
                            <input type="hidden" name="semester" value="<?php echo $currentsem; ?>">
                            <a href="../viewStudent/viewstudent.php?id=<?php echo $row['reg_no'] ?>">
                                <?php echo $row['name'];
                                echo '</br>' ?>
                        <?php
                        }
                    }
                        ?></a>
                            <br>
                            
                </td>
                <td>
                    <?php
                    $secondsql = "SELECT * FROM student where semester = 2";
                    $res = mysqli_query($conn, $secondsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $secondid = $row['semester'];
                            $stu_id = $row['stu_id']; 
                            $currentsem = $row['sem'];?>
                            <input type="checkbox" name="upgradeStudent[]" value="<?php echo $stu_id;?>">
                            <input type="hidden" name="semester" value="<?php echo $currentsem; ?>">
                            <a href="../viewStudent/viewstudent.php?id=<?php echo $row['reg_no'] ?>">
                                <?php echo $row['name'];
                                echo '</br>' ?>
                        <?php
                        }
                    }
                        ?></a>
                            
                </td>
                <td>
                    <?php
                    $thirdsem = "SELECT * FROM student where semester = 3";
                    $res = mysqli_query($conn, $thirdsem);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $thirdid = $row['semester'];
                            $stu_id = $row['stu_id'];
                            $currentsem = $row['semester']; ?>
                            <input type="checkbox" name="upgradeStudent[]" value="<?php echo $stu_id?>">
                            <input type="hidden" name="semester" value="<?php echo $currentsem; ?>">
                            <a href="../viewStudent/viewstudent.php?id=<?php echo $row['reg_no'] ?>">
                                <?php echo $row['name'];
                                echo '</br>' ?>
                        <?php
                        }
                    }
                        ?></a>
                            
                </td>
                <td>
                    <?php
                    $fourthsql = "SELECT * FROM student where semester = 4";
                    $res = mysqli_query($conn, $fourthsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $fourthid = $row['semester'];
                            $stu_id = $row['stu_id'];
                            $currentsem = $row['semester']; ?>
                            <input type="checkbox" name="upgradeStudent[]" value="<?php echo $stu_id?>">
                            <input type="hidden" name="semester" value="<?php echo $currentsem; ?>">
                            <a href="../viewStudent/viewstudent.php?id=<?php echo $row['reg_no'] ?>">
                                <?php echo $row['name'];
                                echo '</br>' ?>
                        <?php
                        }
                    }
                        ?></a>
                            
                </td>
                <td>
                    <?php
                    $fifthsem = "SELECT * FROM student where semester = 5";
                    $res = mysqli_query($conn, $fifthsem);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $fifthid = $row['semester'];
                            $stu_id = $row['stu_id'];
                            $currentsem = $row['semester']; ?>
                            <input type="checkbox" name="upgradeStudent[]" value="<?php echo $stu_id ?>">
                            <input type="hidden" name="semester" value="<?php echo $currentsem; ?>">
                            <a href="../viewStudent/viewstudent.php?id=<?php echo $row['reg_no'] ?>">
                                <?php echo $row['name'];
                                echo '</br>' ?>
                        <?php
                        }
                    }
                        ?></a>
                            
                </td>
                <td>
                    <?php
                    $Sixthsql = "SELECT * FROM student where semester = 6";
                    $res = mysqli_query($conn, $Sixthsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $sixthid = $row['semester']; 
                            $stu_id = $row['stu_id'];
                            $currentsem = $row['semester'];?>
                            <input type="checkbox" name="upgradeStudent[]" value="<?php echo $stu_id?>">
                            <input type="hidden" name="semester" value="<?php echo $currentsem; ?>">
                            <a href="../viewStudent/viewstudent.php?id=<?php echo $row['reg_no'] ?>">
                                <?php echo $row['name'];
                                echo '</br>' ?>
                        <?php
                        }
                    }
                        ?></a>
                </td>
                <td>
                    <?php
                    $seventhsql = "SELECT * FROM student where semester = 7";
                    $res = mysqli_query($conn, $seventhsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $seventhid = $row['semester']; 
                            $stu_id = $row['stu_id'];
                            $currentsem = $row['semester'];?>
                            <input type="checkbox" name="upgradeStudent[]" value="<?php echo $stu_id?>">
                            <input type="hidden" name="semester" value="<?php echo $currentsem; ?>">
                            <a href="../viewStudent/viewstudent.php?id=<?php echo $row['reg_no'] ?>">
                                <?php echo $row['name'];
                                echo '</br>' ?>
                        <?php
                        }
                    }
                        ?></a>
                            
                </td>
                <td>
                    <?php
                    $eighthsql = "SELECT * FROM student where semester = 8";
                    $res = mysqli_query($conn, $eighthsql);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $eightid = $row['semester']; 
                            $stu_id = $row['stu_id'];
                            $currentsem = $row['semester'];?>
                            <input type="checkbox" name="upgradeStudent[]" value="<?php echo $stu_id?>">
                            <input type="hidden" name="semester" value="<?php echo $currentsem; ?>">
                            <a href="../viewStudent/viewstudent.php?id=<?php echo $row['reg_no'] ?>">
                                <?php echo $row['name'];
                                echo '</br>' ?>
                        <?php
                        }
                    }
                        ?></a>
                            
                </td>
            </tr>
        </table>
        <button type="submit" name="upgrade" value="<?php echo $firstid ?>">Upgrade Semester</button>
    </form>
    <hr>
    <form action="../verification/approveReg.php" method="post">
        <table>
            <tr>
                <th>Name</th>
                <th>Semester</th>
                <th>Reg No</th>
                <th>Status</th>
            </tr>
            <?php
            $selectSQL = "SELECT * FROM student where reg_no IS NOT NULL AND is_verified = 0;";
            $response = mysqli_query($conn, $selectSQL);
            if (mysqli_num_rows($response) > 0) {
                while ($fetch = mysqli_fetch_assoc($response)) {
            ?>
                    <tr>
                        <td><?php echo $fetch['name'] ?></td>
                        <td><?php echo $fetch['semester'] ?></td>
                        <td><?php echo $fetch['reg_no'] ?></td>
                        <td><button type="submit" name="submit" value=<?php echo $fetch['stu_id'] ?> onclick="return approvalConfirm()">Approve</button> <button type="submit" name="decline" onclick="return denyConfirm()" value="<?php echo $fetch['stu_id'] ?>">Decline</button></td>
                    </tr>
            <?php
                }
            }
            ?>
    </form>
    </table>
    <?php
if (isset($_POST['upgrade'])) {
    if (isset($_POST['upgradeStudent'])) {
        $selectedStudents = $_POST['upgradeStudent'];
        $semester = $_POST['semester'];
        foreach ($selectedStudents as $studentId) {

            $getsemSQL = "SELECT sem_id from semester_enroll where stu_id = '$studentId' and status = 'studying'";
            $res = mysqli_query($conn,$getsemSQL);
            if (mysqli_num_rows($res)>0) {
                while ($fetch = mysqli_fetch_assoc($res)) {
                    $nowSem = $fetch['sem_id'];
                }
            }


            $upgradesemester = "UPDATE student SET semester = semester + 1 WHERE stu_id = $studentId";
            $response = mysqli_query($conn, $upgradesemester);
            if ($response) {
                // Update status of previous semester enrollment to "passed"
                $updateStatus = "UPDATE semester_enroll SET status = 'passed' WHERE stu_id = $studentId AND sem_id = $nowSem";
                $updateResponse = mysqli_query($conn, $updateStatus);
                if (!$updateResponse) {
                    // Handle error or logging as needed
                }
                // Insert new enrollment record for the current semester
                $insertSemesterEnroll = "INSERT INTO semester_enroll (sem_id, stu_id, status) VALUES ($nowSem+1, $studentId, 'studying')";
                $insertResponse = mysqli_query($conn, $insertSemesterEnroll);
                if (!$insertResponse) {
                    // Handle error or logging as needed
                }
            } else {
                // Handle error or logging as needed
            }
        }
        }
        echo "Semester upgrade successful!";
    }

    ?>
</body>

</html>