<?php
include '../database/dbconnect.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/display.css">

</head>
<body>
<?php
    include_once '../components/navbar.php';
    ?>
    <?php
    $profile=$_SESSION['search'];
    // echo $profile;
    $sql= "SELECT * FROM pdf WHERE name = '$profile'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    // echo $num;
    if($num>0){
       while( $row = mysqli_fetch_assoc($result)){
    ?>
     <div class="wrapper">
        <div class="image">
            <a href="view.php?view='<?php echo $row['f_id'];?>'">
    <img src="<?php echo $row['cover']?>"alt="" srcset="" height="100px">
    </a>
    <br><br>
     <p><?php
           echo $row['name'];
        ?>
        </p>    
    </div>
       
        <br>
        <div class="description">
        <?php
            echo $row['description'];
        ?></div>
        <br>
        
    </div>
    <?php
    }
}
?>
</body>
</html>