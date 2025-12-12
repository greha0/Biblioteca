<?php
    // Connessione al database server SSH

    /*$servername = "mariadb";
        $username = "i5ai3";
        $passwordDb = "password";
        $dbname = "i5ai3";*/

    // Connessione al database per sviluppo locale
    $servername = "localhost";
    $username = "root";
    $passwordDb = "";
    $dbname = "i5ai3";

    // Creazione connessione
    $conn = new mysqli($servername, $username, $passwordDb, $dbname);

    // Controllo connessione
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>