<?php
session_start();
if ($_SESSION["usertype"] != 2) {
    // redirect to error page
    echo '<script>window.location = "../error.php" </script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
    <h2>Admin Page</h2>
    <a href="add_cons.php">Add consulent to database</a><br>
    <a href="accept_users.php">Accept users requests</a><br>
    <form method="POST" action="../login.php">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>

</html>