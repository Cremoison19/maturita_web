<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
</head>

<body>
    <center>
    <h2>Registrati</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <a href="index.php">Torna alle homepage</a><br>
        <label for="email">Email</label>
        <input name="email" placeholder="Email" required><br>
        <label for="password">Password</label>
        <input name="password" type="password" placeholder="Password" required><br>
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

        // controllo valori inseriti 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid format and please re-enter valid email"; 
        }

        // query
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password');";

        if ($pdo->query($sql) === TRUE) {
        echo "New record created successfully";
        } 

    }

?>



</body>

</html>