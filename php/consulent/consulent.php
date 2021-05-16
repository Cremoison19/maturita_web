<?php
session_start();
require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>


</head>

<body>
    <h2>Dashboard</h2>
    <!-- 1. consulent can create new offers, select which users will see them and post them -->
    <form action="create_post.php">
        <input type="submit" name="newpost" value="Create Offer">
    </form>
    <form method="POST" action="../login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    <h2>Statistics</h2>

    <!-- 
        SHOW GRAPHS OF PROFESSIONS SEARCHED BY COMPANIES
        PRINT PROFESSION MOST SEARCHED
    -->

    <?php
        echo "<b>Most researched job</b>: ?.";
    ?>

    <h2>Offers Available</h2>

    <!-- SAME CODE FOR USER -->

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
        $id = $_SESSION["userID"];
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
                    <td>$desc</td>
                    <td><a href=\"remove_post.php?id=$id\">Remove</a></td>
                </tr>";
            }
        }

        ?>
</body>

</html>