<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'agen_colloc');

    $PWD_MIN_LENGTH = 6; 
    // lunghezza minima delle password, impostata qua come variabile globale

    // errori globali
    $dpasswordErr = "Password non valida. Inserisci una password di lunghezza maggiore di 6 caratteri e <br> con almeno un numero.";
    $demailErr = "Email non valida. Assicurati che non ci siano errori di battitura.";



    try{
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function cryptp($data) {
        return md5(md5($data)."50blessings");
        // dopo aver criptato la stringa una volta le aggiungiamo una salt, per poi criptare il tutto un'altra volta
    }

    function redirect($page){
        // inserire in $page il nome del file .php compreso di estensione
        header("Location: /$page");
        echo "<script>document.location.href='$page'</script>";
    }


?>