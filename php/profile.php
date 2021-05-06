<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <h2>My Profile</h2>
    <?php
        $_SESSION['nodata'] = false;
        $id = $_SESSION['userID'];
        $sql = $result = null;
        // IF USER DATA IS EMPTY, GO TO MODIFY USER DATA
        require_once "config.php";
        $sql = "SELECT name FROM users WHERE id = '$id'";
        $result = $pdo->query($sql)->fetch();
    ?>
    <center>
    <form method="POST" action="login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    </center>

    <footer>
        <?php
            echo "User: ".$_SESSION['userEmail']."<br>";
            echo "ID: ".$_SESSION['userID']."<br>";
        ?>
    </footer>
</body>

</html>