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
    <?php
    include '../database/dbconnect.php';
session_start();
$id = $_SESSION['id'];
if($id){
    $countsql = "SELECT COUNT(is_verify) AS count
    FROM pdf
    WHERE is_verify = 0 AND id = $id";
    $res1 = mysqli_query($conn, $countsql);

    if ($res1) {
        $row = mysqli_fetch_assoc($res1);
        // echo $id;
        $count = $row['count'];

        // echo "Count <sup>" . $count. "</sup>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
        
    ?>
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
    <p class="left">
    <a href="../verification/verify.php">Pdf verification<sup><?php echo $count?></sup></a>
    </p>
</nav>
</body>
</html>
