<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo</title>
</head>

<body>
    <?php
        if(empty($_SESSION) or $_SESSION['logged']==false or empty($_SESSION['user'])){
            echo("Per accedere a questa schermata devi avere un account.<br>");
            echo("<a href='signup.php'>Registrati</a><br>");
            echo("<a href='login.php'>Accedi</a>");
        }
    ?>
    <center>

    </center>
</body>

</html>