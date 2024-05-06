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
            <h1><center>Register</center></h1>
            <form action="registerFunc.php" method="post">
                <input type="text" name="name" id="name" autocomplete="off" placeholder="Enter Full name" required><br>
                <input type="email" name="email" id="email" autocomplete="off" pattern="[a-zA-Z0-9._%+-]+@davnepal\.edu\.np$" required placeholder="Enter Email"> <br>
                <input type="text" name="username" id="username" autocomplete="off" required placeholder="Enter Username"><br>
                <input type="password" name="password" id="password" required  autocomplete="off" placeholder="Enter password"><br>
                <label for="role">Select Role</label><select name="role" id="role" onchange="toggleSemesterOption()" required><br>
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
            <center><a href="http://localhost/4thsemProj/authentication/login.php">Already have an Account?</a></center>
        </div>
    </body>

    </html>