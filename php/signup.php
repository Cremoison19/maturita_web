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
        <label for="email">Email</label>
        <input name="email"><br>
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
    $email = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // ottenimento valori dal form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // query
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password');";

    if ($pdo->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

?>



</body>

</html>