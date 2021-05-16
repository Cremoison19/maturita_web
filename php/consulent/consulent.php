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
    <?php // create new offers 

    ?>
    <form action="create_post.php">
        <input type="submit" name="newpost" value="Create Offer">
    </form>
    <form method="POST" action="../login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    <h2>Offers Available</h2>
    <?php // show offers
        
    ?>
</body>

</html>