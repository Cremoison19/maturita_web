<?php

// db data
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'agen_colloc');

// target for uploading cv 
$target_dir = "../uploads";

// target for saving posts for users
// $json_dir = "../json";
// $user_posts_json = "../json/user_posts.json";

// second in a year
$year = 31556926;

// min lenght for passwords
$PWD_MIN_LENGTH = 6;

// global error messages
$dpasswordErr = "Password must be 6 characters long and with at least one number.";
$demailErr = "Email isn't valid. Are you sure you wrote it correctly?";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function cryptp($data)
{
    $salt = "50blessings"; // SALT VALUE
    return md5(md5($data) . $salt);
}

function swap($a, $b)
{
    $c = $a;
    $a = $b;
    $b = $c;
}

function bubblesort($arr)
{
    $len = sizeof($arr);
    do {
        $swap = 0;
        for ($i = 0; $i < $len - 1; $i++) {
            if ($arr[$i] < $arr[$i + 1]) {
                swap($arr[$i], $arr[$i + 1]);
                $swap = 1;
            }
        }
    } while ($swap = 1);
}

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
