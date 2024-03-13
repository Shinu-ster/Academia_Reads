
<?php
    echo 'hello';
    include '../database/dbconnect.php';
    if (isset($_POST['submit'])) {
        echo $_POST['submit'];
        $stu_id = $_POST['submit'];
        $approveSQL = "UPDATE student set is_verified = 1 where stu_id = '$stu_id'";
        $resp = mysqli_query($conn,$approveSQL);
        if ($resp) {
            header("Location:http://localhost/4thsemProj/pages/upgrade.php");
            exit();
        }else{
            echo "Error has Occured";
        }
    }
    if (isset($_POST['decline'])) {
        echo $_POST['decline'];
        $stu_id = $_POST['decline'];
        $declineSQL = "UPDATE student set reg_no = NULL where stu_id = '$stu_id'";
        $resp = mysqli_query($conn,$declineSQL);
        if ($resp) {
            header("Location:http://localhost/4thsemProj/pages/upgrade.php");
            exit();
        }else{
            echo "Error has Occured";
        }
    }
?>