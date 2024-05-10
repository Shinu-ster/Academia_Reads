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

// Update database when a checkbox is checked or unchecked
if (isset($_POST['semester'])) {
    $selectedSemesters = $_POST['semester'];
    foreach ($selectedSemesters as $semester) {
        // Check if the entry already exists in the database
        $checkQuery = "SELECT * FROM teacher_semester WHERE teacher_id = '$profile' AND semester_id = '$semester'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) == 0) {
            // If the entry doesn't exist, insert it
            $insertsem = "INSERT INTO teacher_semester (teacher_id, semester_id) VALUES ('$profile', '$semester')";
            $result = mysqli_query($conn, $insertsem);
        }
    }
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
    <style>
        th {
            background-color: rgb(151, 170, 200, 0.1);
            padding: 0.7%;
        }

        .addSem {
            margin: 20px;
        }

        .addSem input[type='checkbox'] {
            margin-right: 10px;
            margin-top: 5px;
            height: 20px;
            width: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

    </style>
</head>

<body>
    <?php
    include_once '../components/navbar.php';
    $getinfo = "SELECT * FROM user where id = '$profile'";
    $res = mysqli_query($conn, $getinfo);
    $row = mysqli_fetch_assoc($res);
    $isTeachter = $row['is_admin'];
    ?>
    <table border="1">
        <caption>
            <h1>Admin Profile</h1>
        </caption>
        <tr>
            <th>Name: </th>
            <td><?php echo $row['name'] ?></td>
        </tr>
        <tr>
            <th>Username: </th>
            <td><?php echo $row['username'] ?></td>
        </tr>
        <tr>
            <th>Email: </th>
            <td><?php echo $row['email'] ?></td>
        </tr>
    </table>
    <?php
    if ($isTeachter == 0) {
        $getsemID = 'SELECT * FROM semester';
        $result = mysqli_query($conn, $getsemID);
    ?>
        <br>
        <div class="addSem">
            <h3>Which Semester do you Teach?</h3>
            <form action="" method="post">
                <?php
                while ($fetch = mysqli_fetch_assoc($result)) {
                    $sem_id = $fetch['sem_id'];
                    $teaching = false; // Set teaching flag to false by default
                    $getTeachSemId = "SELECT * FROM teacher_semester WHERE teacher_id = '$profile' AND semester_id = '$sem_id'";
                    $response = mysqli_query($conn, $getTeachSemId);
                    if (mysqli_num_rows($response) > 0) {
                        $teaching = true; // Set teaching flag to true if the user is teaching this semester
                    }
                ?>
                    <label>
                        <?php echo $fetch['semester']; ?>:
                        <input type="checkbox" name="semester[]" value="<?php echo $sem_id; ?>" <?php if ($teaching) echo 'checked'; ?>>
                    </label>
                <?php
                }
                ?>
                <button type="submit" name='submit'>Submit</button>
            </form>
        </div>
    <?php
    }
    ?>

</body>

</html>
