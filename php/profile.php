<?php
session_start();
require_once "config.php";
$userdata = json_decode($_SESSION['userdata'], true)[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <h2>Hello, <?php echo $userdata['name'] ?>!</h2>
    <p>Welcome back to your dashboard.</p>

    

    <form method="POST" action="login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    <br>
    <button onclick="window.location.href = 'edit_profile.php';">Edit Profile</button>

</body>

</html>