        <?php
        include '../database/dbconnect.php';
        session_start();
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            $profile = $_SESSION['id'];
            // Allow to use this page only if the session exists
        } else {
            header('location:http://localhost/4thsemProj/login/login.php');
            exit; // Add exit after the header to stop script execution
        }
        if (!isset($_SESSION['is_admin'])) {
            header('location:http://localhost/4thsemProj/pages/display.php');
        }

        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="../styles/home.css?v=<?php echo time(); ?>">
            <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
            <script>
                function showApprovMsg() {
                    alert("Added Succesfully Waiting for Admin approvals")

                }

                function selectGenre() {
                    var genreSelect = document.getElementById("genre");
                    var selectCourse = document.getElementById("courselist");
                    var courseListContainer = document.getElementById("courselistContainer");

                    if (genreSelect.value === "course") {
                        selectCourse.disabled = false;
                        courseListContainer.style.visibility = "visible";
                    } else {
                        selectCourse.disabled = true;
                        courseListContainer.style.visibility = "hidden";
                    }
                    //  = (genreSelect.value != "course

                    console.log(selectCourse.disabled)
                }
            </script>
        </head>

        <body>
            <?php
            include_once '../components/navbar.php';
            ?>
            <div class="container">
                <form action="" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>
                                Name:
                            </td>
                            <td>
                                <input type="text" name="name" id="" required value="<?php echo $row1['name']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Description:
                            </td>
                            <td>
                                <textarea name="desc" id="" cols="30" required rows="10"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                File:
                            </td>
                            <td>
                                <input type="file" name="file" id="" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Cover Photo:
                            </td>
                            <td>
                                <input type="file" name="cover" id="" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Genre:
                            </td>
                            <td>
                                <select name="genre" id="genre" onchange="selectGenre()" required>
                                    <option value="" disabled="disabled" selected>Select genre</option>
                                    <option value="course">Course book</option>
                                    <option value="novels">Novels</option>
                                </select>
                            </td>
                        <tr id="courselistContainer" style="visibility:hidden">
                            <td>
                                Semester
                            </td>
                            <td>
                                <select name="courselist" id="courselist" disabled>
                                    <option value="1">First</option>
                                    <option value="2">Second</option>
                                    <option value="3">Third</option>
                                    <option value="4">Fourth</option>
                                    <option value="5">Fifth</option>
                                    <option value="6">Sixth</option>
                                    <option value="7">Seventh</option>
                                    <option value="8">Eighth</option>
                                </select>
                            </td>
                        </tr>
                        </tr>
                    </table>
                    <button type="submit" name="submit">Submit</button>
                </form>
                <?php

                if (isset($_POST['submit'])) {
                    $name = $_POST['name'];
                    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
                    $file = $_FILES['file']['name'];
                    $temp = $_FILES['file']['tmp_name'];
                    $folder = '../pdfs/' . $file;
                    if (move_uploaded_file($temp, $folder)) {
                        // echo "file moved";
                    } else {
                        echo "file not moved in pdf";
                    }
                    $cover = $_FILES['cover']['name'];
                    $tempcover = $_FILES['cover']['tmp_name'];
                    $foldercover =  '../cover/' . $cover;

                    if (move_uploaded_file($tempcover, $foldercover)) {
                        // echo "file moved";
                    } else {
                        echo "file not moved in cover";
                    }
                    $sem = $_POST['courselist'];
                    $genre = $_POST['genre'];
                    echo $genre;
                    if ($sem == NULL) {
                        echo ("NUll");
                    } else {
                        echo $sem;
                    }
                    $sql = "INSERT INTO pdf (name,description,file,cover,id,upload_date,semester) VALUES ('$name','$desc','$folder','$foldercover','$profile',CURRENT_TIMESTAMP,'$sem')";

                    $res = mysqli_query($conn, $sql);
                    if ($res) {
                        echo '<script>showApprovMsg(); window.location.href = "http://localhost/4thsemProj/pages/display.php";</script>';
                        // header('location:http://localhost/4thsemProj/pages/display.php');
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </body>

        </html>