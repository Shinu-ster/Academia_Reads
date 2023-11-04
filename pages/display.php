<?php
    include '../database/dbconnect.php';
    session_start();
    $profile = $_SESSION['id'];
    if($profile == true){
        //allow to use this page only if session exists
        // echo "session exists";
    }else{
        header('location:http://localhost/4thsemProj/login/login.php');
    }
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
    $sql = "SELECT * FROM pdf";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num>0){
       while( $row = mysqli_fetch_assoc($result)){;
    
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
        ?>
        <br>
        <br>
        <a href="addpdf.php?edit='<?php
            echo $row['f_id'];
        ?>'">
            <button>
                Edit
            </button>
        </a>    
        &nbsp;
        
            <button type='submit' name="delete">
                Delete
            </button>
       
    </div>
        <br>
        
    </div>
    <?php
    }
}
if(isset($_POST['search'])){
    $search = $_POST['search'];
    echo $search;
    $_SESSION['search'] = $search;
   
    // echo $search;
    header('location:http://localhost/4thsemProj/pages/search.php');
}

    ?>
  
   

  
</body>
</html>