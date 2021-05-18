<?php
    session_start();
    if ($_SESSION['userID'] != "admin") header("Location: ../index.php");
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $id = explode("=", parse_url($url, PHP_URL_QUERY))[1];

    require_once "../config.php";
    // delete row from requests table
    $request_user = $pdo->query("SELECT * FROM requests WHERE id = '$id';")->fetch();
    $id = $request_user["id"];
    $email = $request_user["email"];
    $pdo->query("DELETE FROM requests WHERE id = '$id';");
    // delete pdf file from /uploads directory
    $cvPosition = "../../uploads/$email.pdf";
    unlink($cvPosition);
    header("Location: accept_users.php");
?>
