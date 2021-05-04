<?php
session_start();
if(isset($_POST['logout'])) $_SESSION['logged'] = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

<?php
    // file con impostazioni del database
    require_once "config.php";

    // variabili istanziate vuote
    $email = $password = "";
    $emailErr = $passwordErr = "";

    // variabili globali
    
    if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['login'])){
        
        $validate = true;
        
        // ottenimento valori dal form
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        unset($_POST['logout']);
        $_SESSION['logged'] = false;

        if($validate){

            // se la validazione è avvenuta correttamente e quindi la password è corretta, possiamo criptarla prima di inserirla nel database
            $password_c = cryptp($password);

            $result = $sql = "";
            $sql = "SELECT password FROM users WHERE email = '$email'";
            $result = $pdo->query($sql)->fetch();

            // la select non ha dato risultati -> quella email non è mai stata inserita
            if($result == null){
                $emailErr = "Non esiste un account con quell'email. Si prega di registrarsi.";
            }
            else {
                // la password coincide con quella salvata nel database
                if ($result['password'] == $password_c) {
                    $_SESSION['logged'] = true;
                    $_SESSION['userEmail'] = $email;
                    
                    // save user id too
                    $sql = "SELECT id FROM users WHERE email = '$email'";
                    $result = $pdo->query($sql)->fetch();
                    $_SESSION['userID'] = $result['id'];
                    
                    header("Location:/php/profile.php");
                    exit;
                }
                // la password non coincide
                else{
                    $passwordErr = "La password inserita è sbagliata";
                }
            }

        }
        else{
            echo "La validazione ha riscontrato degli errori";
        }

    }

?>

    <center>
    <h2>Login</h2>
    <a href="index.php">Torna alle homepage</a>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <legend for="email">Email</legend>
        <input name="email" type="email"><br>
        <span><?php echo $emailErr;?></span><br>
        <legend for="password">Password</legend>
        <input name="password" type="password"><br>
        <span><?php echo $passwordErr;?></span><br><br><br>
        <input name="login" type="submit" value="Accedi">
        <br><br>
        <a href="signup.php">Registrati</a>
    </form>
</center>
</body>

</html>