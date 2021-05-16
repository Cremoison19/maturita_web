<?php
session_start();
if ($_SESSION['userID'] != "admin") header("Location: ../index.php");
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$id = explode("=", parse_url($url, PHP_URL_QUERY))[1];

require_once "../config.php";
// just delete request
$id = $request_user["id"];
$pdo->query("DELETE FROM requests WHERE id = '$id';");
//echo "<a href='home.php'>home</a>";
header("Location: accept_users.php");
