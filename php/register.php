<?php
        session_start();
        $servername = "localhost";
        $username = "root";
        $passwordDb = ""; //bXHG8p!!4BM9Ngx
        $dbname = "i5ai3";

        $conn = new mysqli($servername, $username, $passwordDb, $dbname);

        if($conn->connect_error){
            die("Connessione fallita: " + $conn->connect_error);
        } else {
            ;
        }

        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $data_nascita = $_POST["data_nascita"];
        $luogo_nascita = $_POST["luogo_nascita"];
        $codice_fiscale = $_POST["codice_fiscale"];
        $numero_telefono = $_POST["numero_telefono"];
        $password = $_POST["password"];
        $username = $_POST["username"];
        $data_creazione = date('Y-m-d');

        $query = "INSERT INTO persona (nome, cognome, data_nascita, luogo_nascita, codice_fiscale, numero_telefono) VALUES ('$nome' , '$cognome', '$data_nascita' , '$luogo_nascita' , '$codice_fiscale' , '$numero_telefono')";
        $_SESSION["descrizione"] = $username;
        $_SESSION["password"] = $password;
        
        if (mysqli_query($conn, $query)) {
            echo "<script>
                    window.location.replace('../index.php');
                  </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    ?>