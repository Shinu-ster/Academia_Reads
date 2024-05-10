<?php
include '../database/dbconnect.php';
if (isset($_GET['view'])) {
    $pdfid = $_GET['view'];
    echo "PDF ID: " . $pdfid;
    $getcomments = "SELECT CASE 
                    WHEN rc.cm_by IS NOT NULL THEN s.name
                    WHEN rc.cm_by_admin IS NOT NULL THEN u.name
                    END AS commenter_name,
                    rc.comment, r.name
                    FROM resource_comment rc 
                    INNER JOIN pdf r ON r.f_id = rc.r_id
                    LEFT JOIN student s ON s.stu_id = rc.cm_by
                    LEFT JOIN user u ON u.id = rc.cm_by_admin
                    WHERE r_id = $pdfid AND rc.is_verified = 1";
    $result = mysqli_query($conn, $getcomments);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Output each comment wrapped in its own <div> with class "comment"
            echo '<div class="comment">';
            echo $row['comment'] . '</br>';
            echo $row['commenter_name'] . '</br>';
            echo '</div>';
        }
    }
}
?>
