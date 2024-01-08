<?php
    include '../database/dbconnect.php';
    session_start();
    if(isset($_SESSION['id'])){
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
    <form action="" method="post">
        Full Name: <input type="text" name="name" id=""><br>
        Username: <input type="text" name="username" id=""><br>
        Password: <input type="password" name="password" id=""><br>
        Email: <input type="email" name="email" id=""> <br>
        Role: <select name="role" id="role" onchange="toggleSemesterOption()"><br>
            <option value="teacher">Teacher</option>
            <option value="student">student</option>
        </select>
        Semester : <select name="sem" id="sem" disabled><br>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
        <button type="submit" name="submit">Submit</button>
    </form>
    <?php
    if ($_POST['role'] == 'teacher') {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $user = $_POST['username'];
            $pass = md5($_POST['password']);
            $email = $_POST['email'];
            $teachersql = "INSERT INTO user (`username`,`name`,`password`,`email`,`is_admin`) VALUES('$user','$name','$pass','$email','0')";
            $result = mysqli_query($conn,$teachersql);
        if($result){
          //redirect to login
          header('location:http://localhost/4thsemProj/login/login.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        }
        
    }elseif($_POST['role'] == 'student'){
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $user = $_POST['username'];
            $pass = md5($_POST['password']);
            $email = $_POST['email'];
            $sem = $_POST['sem'];
            $sql = "INSERT INTO student (username,name,email,password,semester) values('$user','$name','$pass','$email','$sem')";
            $result = mysqli_query($conn,$sql);
            if($result){
              //redirect to login
              header('location:http://localhost/4thsemProj/login/login.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    
    
    ?>
</body>
</html>