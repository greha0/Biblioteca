<?php
// Connessione al database
        $servername = "mariadb";
            $username = "i5ai3";
            $passwordDb = "password";
            $dbname = "i5ai3";

        $conn = new mysqli($servername, $username, $passwordDb, $dbname);

        // Controllo connessione
        if($conn->connect_error){
            header("Location: ../pages/gestionUtenti.php?error=connection_error");
            die;
        } 
        // Controllo se le variabili sono settate
        $codice_fiscale = $_POST["cf_modifica"] ?? null;
        $ruolo = $_POST["nuovo_ruolo"] ?? null;

        // Verifica che i campi non siano vuoti
        if (empty($codice_fiscale) || empty($ruolo)) {
            header("Location: ../pages/gestioneUtenti.php?error=campi_vuoti");
            exit;
        }

        $query = "UPDATE utenti SET ruolo='$ruolo' WHERE cf='$codice_fiscale'";
        if (mysqli_query($conn, $query)) {
            header("Location: ../pages/gestioneUtenti.php");
            exit;
        } else {
            header("Location: ../pages/gestioneUtenti.php?error=update_failed");
            exit;
        }

?>