<?php
session_start();
require_once "../config.php";
// ini_set('display_errors', 0); // to not see Notice erros

if ($_SESSION['usertype'] != 1) header("Location: ../login.php");

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
// $pdo->query("SET FOREIGN_KEY_CHECKS=0;");
$sql = "SELECT DISTINCT users.id, users.name, users.surname, users.profession
        FROM users, consulents 
        WHERE users.consulent = '$userid'
        ORDER BY users.surname";
$result = $pdo->query($sql);

if (isset($_POST['submit'])) {
    if (!empty($_POST['users'])) {
        $users = $_POST['users'];
        for ($i = 0; $i < sizeof($users); $i++) {
            $user = $users[$i];
            $sql = "SELECT user FROM users_offers WHERE user ='$user' AND offer='$postid'";
            $try = $pdo->query($sql)->fetchAll();
            // var_dump($try);
            if ($try == null) {
                $sql = "INSERT INTO `users_offers` (`user`, `offer`) VALUES ('$user', '$postid')";
                $pdo->query($sql);
                echo "Post sent.";
            } else {
                continue;
            }
        }
    }
}

?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" type="media" href="../style.css">
    <title>Send Post</title>
</head>

<body>
    <div class="header container-fluid text-center pb-8">
        <h2>Send Post</h2>
        <button class="btn btn-dark" onclick="window.location.href = 'consulent.php';">Back</button>
    </div>
    <div class="col lg-3 card login mx-auto">
        <div class="card-body rounded">
            <?php
            // print offer infos
            // <input type="checkbox" name="formWheelchair" value="Yes"/> 
            echo "<h3>$company - $role in $location</h3>";
            echo "$desc<br><br>"; ?>

            <div class="users">
                <form method="POST" class="form-check">
                    <!-- <input type="checkbox" name="formWheelchair" value="Yes"/> -->
                    <?php
                    // build checkboxes to send offers to
                    if ($result !== false) {
                        foreach ($result as $row) {
                            $surname = $row["surname"];
                            $name = $row["name"];
                            $id = $row["id"];
                            $profession = $row["profession"];
                            echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"users[]\" value=\"\">";
                            echo "<label class=\"form-check-label\" for=\"users[]\">$surname $name - $profession</label>";
                            echo "<br>";
                        }
                    }
                    ?>
                    <br>
                    <input class="btn btn-dark" type="submit" name="submit" value="Send Post">
                </form>
            </div>
        </div>
    </div>


</body>

</html>