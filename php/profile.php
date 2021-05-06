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
        require_once "config.php";
        
        $sql = $result = null;
        $email = $_SESSION['userEmail'];

        // IF USER DATA IS EMPTY, GO TO MODIFY USER DATA
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $pdo->query($sql)->fetch();

        

    ?>
    <center>
    <form method="POST" action="login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    </center>

    <footer>
        <?php
        echo $_SESSION['userID'];
        ?>
    </footer>
</body>

</html>