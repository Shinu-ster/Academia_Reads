<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/navbar.css?v=<?php echo time(); ?>">
     <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>
</head>
<body>
<nav>
    
   <p>
   <a href="../pages/display.php" >HOME Page</a>
   </p>

    <p class="left">
    <a href="../login/logout.php" onclick="return confirmLogout();">Log out</a>
    </p>
    <p class="left">
    <a href="../crud/addpdf.php">Add pdf</a>
    </p>
</nav>
</body>
</html>
