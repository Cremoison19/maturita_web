<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
</head>

<body>
    <center>
    <h2>Registrati</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin: 50px">
        <a href="index.php">Torna alle homepage</a><br>
        <label for="username">Username</label>
        <input name="username"><br>
        <label for="password">Password</label>
        <input name="password" type="password"><br>
        <input type="submit" value="Registrati">
    </form>
    <a href="login.php">Login</a>
</center>

<?php
    // file con impostazioni del database
    require_once "config.php";

    // variabili istanziate vuote
    $username = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // ottenimento valori dal form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // query
    $stmt = "INSERT INTO users (username, password) VALUES ('$username', '$password');";
    $pdo->prepare($stmt);

}

?>



</body>

</html>