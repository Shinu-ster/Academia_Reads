<?php
include '../database/dbconnect.php';
$searchQuery = $_POST['query'];

$searchsql = "SELECT * FROM pdf where name like '%$searchQuery%'";
$result = mysqli_query($conn,$searchsql);

if ($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
            echo "<div class='wrapper'>
                <div class='image'>
                <a href='../crud/view.php?view=".$row['f_id']."'>
                <img src=".$row['cover']." height='100px'>
                </a>
                </div>
                <div class='title'>
                <p>".$row['name']."
                </p>
                </div>
                <div class='description'>
                ".$row['description']."
                <br>
                </div>
                </div>";
        // echo 'Found';
    }
}else{
    echo 'No result Found';
}
