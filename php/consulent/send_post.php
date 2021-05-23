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

function check_array($str)
{
}

if (isset($_POST['submit'])) {

    // send post (add to users json)
    // from: https://thisinterestsme.com/modifying-json-file-php/
    if (!empty($_POST['users'])) {
        $users = $_POST['users'];
        // open json file
        $json = file_get_contents("../$user_posts_json");
        // var_dump(json_decode($json, true));
        $json_decoded = json_decode($json, true); // json to assoc. array
        foreach ($users as $row) {
            if(in_array((string)$postid, $json_decoded["users"][(string)$row])){
                echo $json_decoded["users"][$row]." post già postato!";
            }
        }
    }
}


?>

<html>

<head>
    <title>Send Post</title>
</head>

<body>
    <h2>Send Post</h2>
    <button onclick="window.location.href = 'consulent.php';">Back</button>
    <?php
    // print offer infos
    // <input type="checkbox" name="formWheelchair" value="Yes"/> 
    echo "<h3>$company - $role in $location</h3>";
    echo "$desc<br><br>"; ?>

    <div class="users">
        <form method="POST">
            <!-- <input type="checkbox" name="formWheelchair" value="Yes"/> -->
            <?php
            // build checkboxes to send offers to
            if ($result !== false) {
                foreach ($result as $row) {
                    $surname = $row["surname"];
                    $id = $row["id"];
                    echo "<label for=\"users[]\">$surname</label>";
                    echo "<input type=\"checkbox\" name=\"users[]\" value=\"$id\"><br>";
                }
            }
            ?>
            <input type="submit" name="submit" value="Send Post">
        </form>
    </div>


</body>

</html>