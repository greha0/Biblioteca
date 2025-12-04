<?php
session_start();

// Connessione al database
$servername = "localhost";
$username = "root";
$passwordDb = "bXHG8p!!4BM9Ngx";
$dbname = "i5ai3-test";

$conn = new mysqli($servername, $username, $passwordDb, $dbname);

// Controllo connessione
if($conn->connect_error){
    header("Location: ../pages/login.php?errore=connessione");
    exit;
}

// Recupero delle credenziali dal form
$username = $_POST["username"];
$password = $_POST["password"];

// Verifica delle credenziali
$query = "SELECT `username`, `password`, `cf`, `id_utente`, `ruolo` FROM `utenti` WHERE username='$username'";
$result = $conn->query($query);

// Controllo se l'utente esiste
if ($result->num_rows > 0) {
    // Utente trovato, verifica password
    $row = $result->fetch_assoc();
    if(strcmp($row["password"], $password)==0){
        // Imposto le variabili di sessione
        $_SESSION["cf"] = $row["cf"];
        $_SESSION["id_utente"] = $row["id_utente"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["ruolo"] = $row["ruolo"];

        header("Location: ../index.php");
        exit;
    } else {
        header("Location: ../pages/login.php?error=password");
        exit;
    }
} else {
    header("Location: ../pages/login.php?error=utente");
    exit;
}
?>