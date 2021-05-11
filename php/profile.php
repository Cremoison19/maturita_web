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

        $data = null;

        // decode json data into an associative array
        $data = json_decode($_SESSION['userdata'], true);
        echo $data["Name"];
        
    ?>
    <center>
    <form method="POST" action="login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    <br>
    <button onclick="window.location.href = 'edit_profile.php';">Edit Profile</button>
    </center>

    <footer>
        <?php
        echo 'User ID: '. $_SESSION['userID'];
        ?>
    </footer>
</body>

</html>