<?php
	session_start();
    if ($_SESSION['userID'] != "admin") header("Location: ../index.php");
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $id = explode("=", parse_url($url, PHP_URL_QUERY))[1];
    
    require_once "../config.php";

    $email = $password = $name = $surname = $birthday = $birthplace = $profession = "";
    $consulent = 0;

    // find the consulent with less users binded
    // consulente con meno utenti collegati
    // contare e trovare il minimo di select count(id) from users where consulent = x;
    $consulent=1; 

    // get things from requests and pass them to users
    $request_user = $pdo->query("SELECT * FROM requests WHERE id = '$id';")->fetch();
        $email = $request_user["email"];
        $password = $request_user["password"];
        $name = $request_user["name"];
        $surname = $request_user["surname"];
        $birthday = $request_user["birthday"];
        $birthplace = $request_user["birthplace"];
        $profession = $request_user["profession"];
        echo $email;
    $sql = "INSERT INTO users (email, password, name, surname, birthday, birthplace, consulent, profession)
    VALUES ('$email', '$password', '$name', '$surname', '$birthday', '$birthplace', '$consulent', '$profession');";
    $result = $pdo->query($sql);

    // delete request
    $id = $request_user["id"];
    $pdo->query("DELETE FROM requests WHERE id = '$id';");
    //echo "<a href='home.php'>home</a>";
    header("Location: accept_users.php");
