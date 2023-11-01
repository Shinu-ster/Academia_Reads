<?php
    include '../database/dbconnect.php';
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
    $sql = "SELECT * FROM pdf";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num>0){
       while( $row = mysqli_fetch_assoc($result)){;
    
    ?>
    <div class="wrapper">
        <div class="image">
    <img src="<?php echo $row['cover']?>"alt="" srcset="" height="100px"><br><br>
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