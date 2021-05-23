<?php
session_start();
require_once "../config.php";

if ($_SESSION['usertype'] != 1) header("Location: ../index.php");

$userid = $_SESSION["userdata"]["id"];
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$postid = explode("=", parse_url($url, PHP_URL_QUERY))[1];

$sql = "SELECT company, role, salary, location, description FROM offers WHERE id='$postid';";
$result = $pdo->query($sql)->fetch();

$company = $result["company"];
$role = $result["role"];
$location = $result["location"];
$desc = $result["description"];

// get datas of users
$sql = "SELECT DISTINCT users.id, users.name, users.surname, users.profession
        FROM users, consulents 
        WHERE users.consulent = '$userid'
        ORDER BY users.surname";
$result = $pdo->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // send post (add to users json)
    
}

?>

<html>

<head>
    <title>Send Post</title>
</head>

<body>
    <h2>Send Post</h2>
    <?php
    // print offer infos
    // <input type="checkbox" name="formWheelchair" value="Yes"/> 
    echo "<h3>$company - $role in $location</h3><br>";
    echo "$desc"; ?>

    <form method="POST">
        <!-- <input type="checkbox" name="formWheelchair" value="Yes"/> -->
        <?php
        // check users to sent offers to
        if ($result !== false) {
            foreach ($result as $row) {
                $surname = $row["surname"];
                $id = $row["id"];
                echo "<label for=\"$surname\">$surname</label>";
                echo "<input type=\"checkbox\" name=\"$surname\" value=\"$id\"><br>";
            }
        }
        ?>
        <input type="submit" value="Send Post">
    </form>


</body>

</html>