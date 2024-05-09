<?php
include '../database/dbconnect.php';
session_start();
$profile = $_SESSION['id'];
$readid = $_GET['show'];
if ($profile == true) {
    //allow to use this page only if session exists
    // echo "session exists";
} else {
    header('location:http://localhost/4thsemProj/authentication/login.php');
}
$getlocation = "SELECT * FROM pdf where f_id = $readid";
$res = mysqli_query($conn, $getlocation);
$num = mysqli_num_rows($res);
if ($num == 1) {
    while ($data = mysqli_fetch_assoc($res)) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../styles/global.css?v=<?php echo time(); ?>">
            <title>Document</title>
            <style>
                embed {
                    height: 1000px;
                }
            </style>
        </head>

        <body>
            <?php
            require_once '../vendor/autoload.php';

            // Example file path
            $file_path = $data['file'];
            
            // Get the file extension
            $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

            // Display PDF files directly using embed
            if ($file_extension === 'pdf') {
                ?>
                <embed src="<?php echo $file_path;?>#toolbar=0" type="application/pdf" width="100%" height="1000px">
                <?php
            } elseif ($file_extension === 'docx') {
                // Convert DOCX to HTML
                $phpWord = \PhpOffice\PhpWord\IOFactory::load($file_path);
                $html_writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
                $temp_html_file = tempnam(sys_get_temp_dir(), 'phpword');
                $html_writer->save($temp_html_file);

                // Read the HTML content
                $html_content = file_get_contents($temp_html_file);

                // Display HTML content in an iframe
                ?>
                <iframe srcdoc="<?php echo htmlentities($html_content); ?>" width="100%" height="1000px"></iframe>
                <?php
            } else {
                // Handle other file types or show an error message
                echo "Unsupported file format";
            }
            ?>
        </body>

        </html>
<?php
    }
}
?>
