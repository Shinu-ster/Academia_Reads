<?php
include '../database/dbconnect.php';

$sql = "SELECT * FROM pdf where is_verify = 0 and is_reuploaded is NULL";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num > 0) {
    echo "<table border=1>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Semester</th>
                <th>Cover</th>
                <th>Verify</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "
        <tr>
            <td>" . $row['name'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['semester'] . "</td>
            <td>
                <a href='http://localhost/4thsemProj/pages/read.php?show=" . $row['f_id'] . "'><img src='" . $row['cover'] . "' height='100px' width='100px'></a>
            </td>
            <td>
                <form action='' method='post'>
                    <button type='submit' name='approve' value='" . $row['f_id'] . "'>Approve</button>
                    <button type='button' onclick='showDenyModal(" . $row['f_id'] . ")'>Deny</button>
                </form>
            </td>
        </tr>
        ";
    }
    echo "</table>";
}
?>
