<?php
session_start();
if (isset($_POST['logout'])) $_SESSION['logged'] = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Consulents</title>
</head>

<body>



    <h2>Admin Accept Users</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <a href="../index.php">Torna alle homepage</a><br><br>
    </form>
    <a href="admin.php">Back</a>
    <table>
        <tr>
            <th>ID</th>
            <th>E-mail</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Created at</th>
        </tr>
    <?php

        require_once "../config.php";

        // get all requests from users
        $sql = "SELECT id, email, name, surname, created_at FROM requests;";
        $result = $pdo->query($sql);

        // https://coursesweb.net/php-mysql/display-data-array-mysql-html-table_t
        // select to table guide
        if ($result !== false) {
            foreach ($result as $row) {
                $id = $row["id"];
                $email = $row["email"];
                $name = $row["name"];
                $surname = $row["surname"];
                $created_at = $row["created_at"];
                $cvPosition = "../../uploads/$email.pdf";

                echo "<tr>
                <td>$id</td>
                <td>$email</td>
                <td>$name</td>
                <td>$surname</td>
                <td>$created_at</td>
                <td>$cvPosition</td>
                <td><a href='accept.php?id=$id'>Accept</a>";
                for ($i = 0; $i < 10; $i++) echo "&nbsp"; // print 10 spaces
                echo "<a href='reject.php?id=$id'>Refuse</a></td>
                </tr>";
                

            }
        }

        ?>

</body>

</html>