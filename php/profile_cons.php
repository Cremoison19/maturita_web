<?php
session_start();
require_once "config.php";
$userdata = json_decode($_SESSION['userdata'], true)[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h2>Hello, <?php echo $userdata['name'] ?>!</h2>
    <p>Welcome back to your dashboard.</p>

    <h3>You</h3>
    <p>Name: <?php echo $userdata['name'] ?></p>
    <p>Surname: <?php echo $userdata['surname'] ?></p>
    <p>Birthday: <?php echo $userdata['birthday'] ?></p>
    <p>Birthplace: <?php echo $userdata['birthplace'] ?></p>
    <p>E-mail: <?php echo $userdata['email'] ?></p>

    <h3>Offers</h3>

    <form method="POST" action="login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    <br>
    <button onclick="window.location.href = 'edit_profile.php';">Edit Profile</button>

</body>

</html>