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

if ($_SESSION['is_admin'] != 1) {
    header('location:http://localhost/4thsemProj/pages/display.php');
    exit(); // Add exit to stop script execution
}

if (isset($_POST['denybutton'])) {
    $reason = mysqli_real_escape_string($conn, $_POST['denyReason']);
    $denyid = $_POST['denybutton'];
    $checkIfExists = "SELECT * from resource_feedback where r_id = $denyid";
    $yesExists = mysqli_query($conn, $checkIfExists);
    if (mysqli_num_rows($yesExists) > 0) {
        $updatefeedback = "UPDATE resource_feedback SET feedback = '$reason', fb_by = $profile WHERE r_id = $denyid;
        UPDATE pdf SET is_reuploaded = 0 WHERE f_id = $denyid";
        $res = mysqli_multi_query($conn, $updatefeedback);
        if ($res) {
            echo 'Feedback sent';
        } else {
            echo 'Error Occurred';
        }
    } else {
        $feedbacksql = "INSERT INTO resource_feedback (`r_id`, `feedback`, `fb_by`) VALUES ($denyid, '$reason', $profile);
        UPDATE pdf SET is_reuploaded = 0 WHERE f_id = $denyid";
        $res = mysqli_multi_query($conn, $feedbacksql);
        if ($res) {
            echo 'Feedback sent';
        } else {
            echo 'Error on sending feedback';
        }
    }
    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}

if (isset($_POST['approve'])) {
    $pdf_id = $_POST['approve'];
    $approvesql = "UPDATE pdf SET is_verify= '1', verified_date = CURRENT_TIMESTAMP WHERE f_id = $pdf_id;
    UPDATE resource_feedback set feedback = NULL where r_id = $pdf_id";
    $approveres = mysqli_multi_query($conn, $approvesql);
    if ($approveres) {
        echo 'Approved pdf';
    }
    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['REQUEST_URI']);
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
    <link rel="stylesheet" href="../styles/table.css?v=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        /* Style the modal */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    include_once '../components/navbar.php';

    $sql = "SELECT * FROM pdf where is_verify = 0 and is_reuploaded is NULL";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    ?>
    <?php
    if ($num == 0) :
    ?>
        <p>No PDFs to Approve yet</p>
    <?php else : ?>
        <div class="results">
        <table border=1>
            <tr>

                <th>Name</th>
                <th>Description</th>
                <th>Semester</th>
                <th>Cover</th>
                <th>Verify</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) :
            ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['semester'];?></td>
                    <td>
                        <a href="http://localhost/4thsemProj/pages/read.php?show=<?php echo $row['f_id'] ?>"><img src="<?php echo $row['cover']; ?>" alt="" srcset="" height="100px" width="100px"></a>
                    </td>
                    <td>
                        <form action="" method="post">
                            <button type="submit" name="approve" value="<?php echo $row['f_id']; ?>">Approve</button>

                            <button type="button" onclick="showDenyModal(<?php echo $row['f_id']; ?>)">Deny</button>

                        </form>
                    </td>
                </tr>
            <?php
            endwhile;
            ?>

        </table>
        </div>
    <?php
    endif;
    ?>

    <div id="denyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="hideDenyModal()">&times;</span>
            <form action="" method="post">
                <label for="denyReason">Deny Reason:</label><br>
                <input type="text" id="denyReason" name="denyReason" required><br>
                <button type="submit" name="denybutton" id="denyButton">Deny</button>
            </form>
        </div>
    </div>
    <script>
        function showDenyModal(pdfId) {
            document.getElementById('denyModal').style.display = 'block';
            document.getElementById('denyButton').value = pdfId;
        }

        function hideDenyModal() {
            document.getElementById('denyModal').style.display = 'none';
        }
        function fetchData() {
            $.ajax({
                url: 'fetch.php', // Replace with the URL of your PHP script that fetches data
                method: 'GET',
                success: function(response) {
                    $('.results').html(response); // Update the result container with the fetched data
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        // Call fetchData() initially to load data when the page loads
        fetchData();

        // Call fetchData() every 5 seconds (5000 milliseconds)
        setInterval(fetchData, 5000); // Adjust the interval as needed
    </script>
</body>

</html>
