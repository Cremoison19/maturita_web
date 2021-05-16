<?php
    session_start();
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $id = explode("=", parse_url($url, PHP_URL_QUERY))[1];

    require_once "../config.php";
// just delete request
    $request_user = $pdo->query("SELECT * FROM offers WHERE id = '$id';")->fetch();
    $id = $request_user["id"];
    $pdo->query("DELETE FROM offers WHERE id = '$id';");
    //echo "<a href='home.php'>home</a>";
    header("Location: consulent.php");
