    <?php
    include '../database/dbconnect.php';
    session_start();
    if (isset($_SESSION['id'])) {
        //if session exists redirect to home page
        header('location:http://localhost/4thsemProj/crud/addpdf.php');
        exit();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../styles/register.css?v=<?php echo time(); ?>">
        <title>Document</title>
        <script>
            function toggleSemesterOption() {
                var roleSelect = document.getElementById("role");
                var semesterSelect = document.getElementById("sem");

                // Disable semester option if the selected role is "teacher", otherwise enable it
                semesterSelect.disabled = (roleSelect.value === "teacher");
            }
        </script>
    </head>

    <body>
        <div class="container">
            <form action="" method="post">
                <label for="name">Full Name:</label> <input type="text" name="name" id="name" required><br>
                <label for="username">Username: </label> <input type="text" name="username" id="username" required><br>
                <label for="password">Password: </label> <input type="password" name="password" id="password" required><br>
                <label for="email" class="email">Email: </label> <input type="email" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@davnepal\.edu\.np$" required> <br>
                <label for="role" class="role"> Role: </label> <select name="role" id="role" onchange="toggleSemesterOption()" required><br>
                    <option value="teacher">Teacher</option>
                    <option value="student">student</option>
                </select> <br><br>
                <label for="sem" class="sem">Semester : </label> <select name="sem" id="sem" disabled><br>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select> <br><br>
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
        <?php
        if ($_POST['role'] == 'teacher') {
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $user = $_POST['username'];
                $pass = md5($_POST['password']);
                $pattern = '/^[a-zA-Z0-9._%+-]+admin+@davnepal\.edu\.np$/';
                $email = $_POST['email'];
                if (!preg_match($pattern, $email)) {
                    echo "<script>alert('Email must be from @davnepal.edu.np domain');</script>";
                } else {
                    $teachersql = "INSERT INTO user (`username`,`name`,`password`,`email`,`is_admin`) VALUES('$user','$name','$pass','$email','0')";
                    $result = mysqli_query($conn, $teachersql);
                    if ($result) {
                        //redirect to login
                        header('location:http://localhost/4thsemProj/login/login.php');
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                }
            }
        } elseif ($_POST['role'] == 'student') {
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $user = $_POST['username'];
                $pass = md5($_POST['password']);
                $pattern = '/^[a-zA-Z0-9._%+-]+@davnepal\.edu\.np$/';
                $email = $_POST['email'];
                if (!preg_match($pattern, $email)) {
                    echo "<script>alert('Email must be from @davnepal.edu.np domain');</script>";
                } else {
                    $sem = $_POST['sem'];
                    $sql = "INSERT INTO student (username,name,email,password,semester) values('$user','$name','$email','$pass','$sem')";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        //redirect to login
                        header('location:http://localhost/4thsemProj/login/login.php');
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                }
            }
        }


        ?>
    </body>

    </html>