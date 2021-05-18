<?php
// require_once "config.php";
?>
<html>

<head>
</head>

<body>
    <?php
    if (isset($_POST)) {

        $f = opendir("../uploads");
        $dirs = array();
        while (($entry = readdir($f)) !== false) {
            array_push($dirs, $entry);
        }

        $file = $_FILES['file'];

        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        if (true) {
            if (!(in_array($fileName, $dirs) !== false)) {
                //CHECK FILE
                if (strpos(strtolower($fileName), ".pdf") === false) echo "File extension not allowed.<br/><br/>";
                else if (intval($fileSize / 1024) > 1024) echo "File is too large (Max 1MB)<br><br>";
                else {
                    //echo "nell'if";
                    $fileDest = '../uploads/' . "mirkopiras.01@gmail.com" . ".pdf";
                    rename($fileTmp, $fileDest);
                    echo "File uploaded.";
                }
            } else {
                echo "";
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