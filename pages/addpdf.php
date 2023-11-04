<?php
    include '../database/dbconnect.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        $profile = $_SESSION['id'];
        // Allow to use this page only if the session exists
    } else {
        header('location:http://localhost/4thsemProj/login/login.php');
        exit; // Add exit after the header to stop script execution
    }
    $f_id = $_GET['edit'];
    if($f_id == true){
        $sql1 = "SELECT * FROM pdf WHERE f_id = '$f_id'";
        $result1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_fetch_assoc($result1);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/home.css">
</head>
<body>
   <?php
   include_once '../components/navbar.php';
   ?>
<form action="" method="post" enctype="multipart/form-data">
   Name: <input type="text" name="name" id="" value="<?php
    echo $row1['name'];
   ?>"><br>
   Description: <textarea name="desc" id="" cols="30" rows="10"><?php 
    if($f_id == true){
   echo $row1['description']; }else{ ?>
    Add Description <?php
   }
    ?>
</textarea><br>
<br>
   File: <input type="file" value= <?php
    echo $row1['file'];
   ?>name="file" id=""><br>
   Cover Photo: <input type="file" name="cover" id=""
   value="<?php
    echo $row1['cover'];
   ?>"
   ><br>
   <?php
    if($f_id == false){
   ?>
   <button type="submit" name="submit">Submit</button>
   <?php
    }else{
   ?>
   <button type = "submit" name="edit">Edit</button>
   </form>
   <?php
    }
   if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $file = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $folder = "../pdf/" . $file;
        if (move_uploaded_file($temp, $folder)) {
            // echo "file moved";
        } else {
            echo "file not moved";
        }
        $cover = $_FILES['cover']['name'];
        $tempcover = $_FILES['cover']['tmp_name'];
        $foldercover =  '../cover/' . $cover;
      
        if (move_uploaded_file($tempcover, $foldercover)) {
            // echo "file moved";
        } else {
            echo "file not moved";
        }
        echo $profile;
   
   $sql = "INSERT INTO pdf (name,description,file,cover,id) VALUES ('$name','$desc','$folder','$foldercover','$profile')";
  
   $res = mysqli_query($conn, $sql);
   if ($res) {
       echo "Inserted successfully";
   } else {
       echo "Error: " . mysqli_error($conn);
   }
} 
if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $file = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $folder = "../pdf/" . $file;
    if (move_uploaded_file($temp, $folder)) {
        // echo "file moved";
    } else {
        echo "file not moved";
    }
    $cover = $_FILES['cover']['name'];
    $tempcover = $_FILES['cover']['tmp_name'];
    $foldercover =  '../cover/' . $cover;
  
    if (move_uploaded_file($tempcover, $foldercover)) {
        // echo "file moved";
    } else {
        echo "file not moved";
    }
    $sql2 = "UPDATE `pdf` SET `name`='$name',`description`='$desc',`file`='$folder',`cover`='$foldercover' WHERE `f_id` = '$f_id'";
    $res2 = mysqli_query($conn, $sql2);
    if ($res2) {
        echo "Updated successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

   ?>
</body>
</html>