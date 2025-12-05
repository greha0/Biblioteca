<?php
        session_start();

        // Connessione al database
        $servername = "mariadb";
            $username = "i5ai3";
            $passwordDb = "password";
            $dbname = "i5ai3";

        $conn = new mysqli($servername, $username, $passwordDb, $dbname);

        // Controllo connessione
        if($conn->connect_error){
            header("Location: ../pages/register.php?error=connection_error");
            die;
        } 

        // Controllo se le variabili sono settate
        $nome = $_POST["nome"] ?? null;
        $cognome = $_POST["cognome"] ?? null;
        $data_nascita = $_POST["data_nascita"] ?? null;
        $luogo_nascita = $_POST["luogo_nascita"] ??  null;
        $codice_fiscale = $_POST["codice_fiscale"] ?? null;
        $numero_telefono = $_POST["numero_telefono"] ?? null;
        $password = $_POST["password"] ?? null;
        $username = $_POST["username"] ?? null;
        $email = $_POST["email"] ?? null;
        
        //Data di creazione account
        $data_creazione = date('Y-m-d');

        // Controllo che non esista già un utente con lo stesso codice fiscale
        $checkQuery = "SELECT cf FROM persone WHERE cf='$codice_fiscale'";
        $checkResult = $conn->query($checkQuery);
        if ($checkResult->num_rows > 0) {
            header("Location: ../pages/register.php?error=cf_exists");
            exit;
        }

        // Verifica che i campi non siano vuoti
        if (empty($cognome) || empty($data_nascita) || empty($luogo_nascita) || empty($codice_fiscale) || empty($numero_telefono) || empty($password) || empty($username) || empty($email) || empty($nome)) {
            header("Location: ../pages/register.php?error=campi_vuoti");
            exit;
        }

        // Validazione del formato del numero di telefono
        if (!preg_match('/^[0-9]{10}$/', $numero_telefono)) {
            header("Location: ../pages/register.php?error=numero_telefono");
            exit;
        }

        // Validazione del formato del codice fiscale (semplificata)
        if (!preg_match('/^[A-Z0-9]{16}$/', $codice_fiscale)) {
            header("Location: ../pages/register.php?error=codice_fiscale");
            exit;
        }

        // Validazione formato email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../pages/register.php?error=email");
            exit;
        }

        // Validazione data di nascita (non futura)
        if (strtotime($data_nascita) > time()) {
            header("Location: ../pages/register.php?error=data_nascita");
            exit;
        }

        //validazione data di nascita troppi anni fa
        $minDate = date('Y-m-d', strtotime('-120 years'));
        if ($data_nascita < $minDate) {
            header("Location: ../pages/register.php?error=data_nascita");
            exit;
        }

        //validazione username univoco
        $checkQuery = "SELECT username FROM utenti WHERE username='$username'";
        $checkResult = $conn->query($checkQuery);
        if ($checkResult->num_rows > 0) {
            header("Location: ../pages/register.php?error=username");
            exit;
        }


        // Inserimento dei dati nel database
        $query = "INSERT INTO persone (cf, nome, cognome, data_nascita, luogo_nascita, tel, email) VALUES ('$codice_fiscale' ,'$nome' , '$cognome', '$data_nascita' , '$luogo_nascita', '$numero_telefono', '$email')";
            
        // Esecuzione della query
        if (mysqli_query($conn, $query)) {
            // Successo
        } else {
            header("Location: ../pages/register.php?error=registration_failed");
            exit;
        }

        // Salvare codice fiscale in sessione
        $_SESSION["cf"] = $codice_fiscale;

        // Aggiunta dell'utente alla tabella utenti
        $query = "INSERT INTO `utenti`(`username`, `password`, `cf`, `ruolo`) VALUES ('$username','$password','$codice_fiscale', 'utente')";

        // Esecuzione della query
        if (mysqli_query($conn, $query)) {
            $_SESSION["id_utente"] = mysqli_insert_id($conn);
            echo "<script>
                    window.location.replace('../pages/areaUtente.php');
                  </script>";
        } else {
            header("Location: ../pages/register.php?error=registration_failed");
            exit;
        }

        // Salvare username in sessione
        $_SESSION["username"] = $username;
        $_SESSION["ruolo"] = "utente";
        
        mysqli_close($conn);
    ?>