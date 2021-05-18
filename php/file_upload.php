<?php
require_once "config.php";
?>
<html>

<head>
</head>

<body>
    <?php
    if () {

        $f = opendir("/uploads");
        $dirs = array();
        while (($entry = readdir($f)) !== false) {
            array_push($dirs, $entry);
        }

        $file = $_FILES['file'];
        var_dump($file);

        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        if (true) {
            if (!(in_array($fileName, $dirs) !== false)) {
                //CHECK FILE
                if (strpos(strtolower($fileName), ".pdf") === false) {
                    echo "<center>";
                    echo "File extension not allowed.<br/><br/>";
                    echo "</center>";
                } else if (intval($fileSize / 1024) > 51200) {
                    echo "<center>";
                    echo "File is too large.<br/><br/>";
                    echo "</center>";
                } else {
                    //echo "nell'if";
                    $fileDest = '/uploads/' . $fileName;
                    move_uploaded_file($fileTmp, $fileDest);
                    echo "LESGOOO";
                }
            } else {
                if ($fileName != "") {
                    echo "<center><br/>This file name is already used.<br/><br/>";
                    include 'style/homebutton.php';
                    echo "</center>";
                } else {
                    echo "<center><br/>You have to select a file first.<br/><br/>";
                    include 'style/homebutton.php';
                    echo "</center>";
                }
            }
        } 
    }
    
    ?>
    <h2>File Upload</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Upload">
    </form>
</body>

</html>