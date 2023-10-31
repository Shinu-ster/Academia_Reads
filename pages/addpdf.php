<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/home.css">
</head>
<body>
    <nav>
        <p>HOME Page</p>
    <input type="search" name="" id="">
</nav>
<form action="" method="post">
   Name: <input type="text" name="name" id=""><br>
   Description: <textarea name="desc" id="" cols="30" rows="10">Add Description</textarea><br>
   File: <input type="file" name="file" id=""><br>
   Cover Photo: <input type="file" name="cover" id=""><br>
   <button type="submit" name="submit">Submit</button>
   </form>
   <?php
   if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $file = $_FILES['file'];
        $cover = $_FILES['cover'];
    }    
   $sql = "INSERT INTO pdf (name,description,file,cover) VALUES ('$name','$desc','$file','$cover')";
   ?>
</body>
</html>