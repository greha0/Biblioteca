<?php
        session_start();
        $servername = "localhost";
        $username = "root";
        $passwordDb = "bXHG8p!!4BM9Ngx"; //bXHG8p!!4BM9Ngx
        $dbname = "i5ai3";

        $conn = new mysqli($servername, $username, $passwordDb, $dbname);

        if($conn->connect_error){
            die("Connessione fallita: " + $conn->connect_error);
        } else {
            ;
        }

        // Controllo variabili
        $cognome = isset($_POST["cognome"]) ? mysqli_real_escape_string($conn, $_POST["cognome"]) : null;
        $data_nascita = isset($_POST["data_nascita"]) ? mysqli_real_escape_string($conn, $_POST["data_nascita"]) : null;
        $luogo_nascita = isset($_POST["luogo_nascita"]) ? mysqli_real_escape_string($conn, $_POST["luogo_nascita"]) : null;
        $codice_fiscale = isset($_POST["codice_fiscale"]) ? mysqli_real_escape_string($conn, $_POST["codice_fiscale"]) : null;
        $numero_telefono = isset($_POST["numero_telefono"]) ? mysqli_real_escape_string($conn, $_POST["numero_telefono"]) : null;
        $password = isset($_POST["password"]) ? $_POST["password"] : null;
        $username = isset($_POST["username"]) ? mysqli_real_escape_string($conn, $_POST["username"]) : null;
        $data_creazione = date('Y-m-d');

        // Verifica che i campi non siano vuoti
        if (empty($cognome) || empty($data_nascita) || empty($luogo_nascita) || empty($codice_fiscale) || empty($numero_telefono) || empty($password) || empty($username)) {
            header("Location: ../pages/register.php?error=campi_vuoti");
            exit;
        }

        // Validazione del formato del numero di telefono
        if (!preg_match('/^[0-9]{11}$/', $numero_telefono)) {
            header("Location: ../pages/register.php?error=numero_telefono");
            exit;
        }

        // Validazione del formato del codice fiscale (se necessario)
        if (!preg_match('/^[A-Z0-9]{16}$/', $codice_fiscale)) {
            header("Location: ../pages/register.php?error=codice_fiscale");
            exit;
        }


        $query = "INSERT INTO persona (nome, cognome, data_nascita, luogo_nascita, codice_fiscale, numero_telefono) VALUES ('$nome' , '$cognome', '$data_nascita' , '$luogo_nascita' , '$codice_fiscale' , '$numero_telefono')";
        $_SESSION["descrizione"] = $username;
        $_SESSION["password"] = $password;
        
        if (mysqli_query($conn, $query)) {
            $last_id = mysqli_insert_id($conn);
            echo "<script>
                    window.location.replace('../pages/login.php');
                  </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        $query = "INSERT INTO `utente`(`descrizione`, `password`, `id_persona`) VALUES ('$username','$password','$last_id')";

        if (mysqli_query($conn, $query)) {
            echo "<script>
                    window.location.replace('../pages/login.php');
                  </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    ?>