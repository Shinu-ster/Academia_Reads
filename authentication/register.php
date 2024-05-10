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
    <title>Register</title>
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
        <h1>Register</h1>
        <form action="registerFunc.php" method="post">
            <div class="form-group">
                <input type="text" name="name" id="name" autocomplete="off" placeholder="Enter Full Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" autocomplete="off" pattern="[a-zA-Z0-9._%+-]+@davnepal\.edu\.np$" required placeholder="Enter Email">
            </div>
            <div class="form-group">
                <input type="text" name="username" id="username" autocomplete="off" required placeholder="Enter Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" required autocomplete="off" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label for="role">Select Role</label>
                <select name="role" id="role" onchange="toggleSemesterOption()" required>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sem" class="sem">Semester:</label>
                <select name="sem" id="sem" disabled>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
        <div class="register-link">
            Already have an account? <a href="http://localhost/4thsemProj/authentication/login.php">Login</a>
        </div>
    </div>
</body>

</html>
