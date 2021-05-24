<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'agen_colloc');
    
    // target for uploading cv 
    $target_dir = "../uploads"; 
    // target for saving posts for users
    $json_dir = "../json";
    $user_posts_json = "../json/user_posts.json";



    // min lenght for passwords
    $PWD_MIN_LENGTH = 6; 

    // global error messages
    $dpasswordErr = "Password must be 6 characters long and with at least one number.";
    $demailErr = "Email isn't valid. Are you sure you wrote it correctly?";

    $year = 31556926; // second in a year

    try{
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function cryptp($data) {
        $salt = "50blessings"; // SALT VALUE
        return md5(md5($data).$salt);
    }

    function createJSON($id){
        try{
            $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // get data from database
            $stmt = $pdo->prepare("SELECT name, surname, birthday, birthplace, email FROM users WHERE id = '$id'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return json_encode($result);

        } catch(PDOException $e){
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }

    function new_line($text){
        echo '<p> $text </p><br>';
    }

?>