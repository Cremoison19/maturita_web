<?php
session_start();
require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="p-4 pt-8">
        <div class="header container-fluid text-center pb-8">
            <h2>Dashboard</h2>
            <!-- 1. consulent can create new offers, select which users will see them and post them -->
            <form action="create_post.php">
                <input class="btn btn-dark" type="submit" name="newpost" value="Create Offer">
            </form>
            <form method="POST" action="../login.php">
                <input class="btn btn-light" type="submit" name="logout" value="Logout">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="infos col-lg-3">
            <h2>Statistics</h2>
            <?php

            // count of offers
            $sql = "SELECT * FROM professions";
            $professions = $pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
            // building array
            $candidates = array();
            foreach ($professions as $p) {
                $sql = "SELECT COUNT(id) FROM users WHERE profession = '$p'";
                $count = $pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
                //echo var_dump($count) . "<br>";
                array_push($candidates, [$p, $count[0]]);
            }
            echo "<b>Profession | Number of Users</b><br>";
            for ($i = 0; $i < sizeof($candidates); $i++) {
                $job = $candidates[$i][0];
                $count = $candidates[$i][1];
                echo "$job | " . $count . "<br>";
            }
            echo "<br>";

            ?>
        </div>
        <div class="offers-dashboard col-lg-8">
            <h2>Offers Available</h2>

            <table>
                <tr>
                    <th>Company</th>
                    <th>Profession</th>
                    <th>Salary</th>
                    <th>Location</th>
                    <th>Description</th>
                </tr>
                <?php

                require_once "../config.php";
                $id = $_SESSION["userdata"]["id"];
                // get all requests from users
                $sql = "SELECT id, company, role, salary, location, description FROM offers WHERE consulent='$id';";
                $result = $pdo->query($sql);

                // https://coursesweb.net/php-mysql/display-data-array-mysql-html-table_t
                // select to table guide
                if ($result !== false) {
                    foreach ($result as $row) {
                        $id = $row["id"];
                        $company = $row["company"];
                        $role = $row["role"];
                        $salary = $row["salary"];
                        $location = $row["location"];
                        $desc = $row["description"];

                        echo "<tr>
                    <td>$company</td>
                    <td>$role</td>
                    <td>€$salary</td>
                    <td>$location</td>
                    <td class=\"desc\">$desc</td>
                    <td><a class=\"btn btn-light\" href=\"send_post.php?id=$id\">Send Post</a></td>
                    <td><a class=\"btn btn-light\" href=\"remove_post.php?id=$id\">Remove</a></td>
                    </tr>";
                    }
                }

                ?>
        </div>
    </div>
</body>

</html>