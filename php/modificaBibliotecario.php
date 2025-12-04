<?php
// Connessione al database
        $servername = "localhost";
        $username = "root";
        $passwordDb = "bXHG8p!!4BM9Ngx";
        $dbname = "i5ai3-test";

        $conn = new mysqli($servername, $username, $passwordDb, $dbname);

        // Controllo connessione
        if($conn->connect_error){
            header("Location: ../pages/gestionUtenti.php?error=connection_error");
            die;
        } 

        // Controllo se le variabili sono settate
        $codice_fiscale = $_POST["cf"] ?? null;
        $nuovo_username = $_POST["username"] ?? null;
        $nuova_password = $_POST["password"] ?? null;
        $nuovo_telefono = $_POST["tel"] ?? null;
        $nuova_email = $_POST["email"] ?? null;
        $nuovo_ruolo = $_POST["ruolo"] ?? null;

        // Controllo che esista un bibliotecario con quel codice fiscale
        $checkQuery = "SELECT cf FROM utenti WHERE cf='$codice_fiscale' AND ruolo='bibliotecario'";
        $checkResult = $conn->query($checkQuery);   
        if ($checkResult->num_rows == 0) {
            header("Location: ../pages/gestioneUtenti.php?error=bibliotecario_non_trovato");
            exit;
        }

        // Verifica che i campi non siano vuoti
        if (empty($codice_fiscale) || empty($nuovo_username) || empty($nuova_password) || empty($nuovo_telefono) || empty($nuova_email) || empty($nuovo_ruolo)) {
            header("Location: ../pages/gestioneUtenti.php?error=campi_vuoti");
            exit;
        }

        // Validazione del formato del numero di telefono
        if (!preg_match('/^[0-9]{10}$/', $nuovo_telefono)) {
            header("Location: ../pages/gestioneUtenti.php?error=numero_telefono");
            exit;
        }

        // Validazione formato email
        if (!filter_var($nuova_email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../pages/gestioneUtenti.php?error=email");
            exit;
        }

        // Aggiornamento delle informazioni del bibliotecario
        $updateQuery = "UPDATE utenti SET username='$nuovo_username', password='$nuova_password', telefono='$nuovo_telefono', email='$nuova_email', ruolo='$nuovo_ruolo' WHERE cf='$codice_fiscale'";
        if ($conn->query($updateQuery) === TRUE) {
            header("Location: ../pages/gestioneUtenti.php");
            exit;
        } else {
            header("Location: ../pages/gestioneUtenti.php?error=update_failed");
            exit;
        }
?>