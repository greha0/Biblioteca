<?php
session_start();

include("../php/connessioneDatabase.php");

// Recupero delle credenziali dal form
$username = $_POST["username"];
$password = $_POST["password"];

// Crittografia della password
$password = crypt($password, '$2y$10$forzanapoli2026salt$');

// Verifica delle credenziali
$query = "SELECT `username`, `password`, `cf`, `id_utente`, `ruolo` FROM `utenti` WHERE username='$username'";
$result = $conn->query($query);

// Controllo se l'utente esiste
if ($result->num_rows > 0) {
    // Utente trovato, verifica password
    $row = $result->fetch_assoc();
    if(hash_equals($row["password"], $password)) {
        // Imposto le variabili di sessione
        $_SESSION["cf"] = $row["cf"];
        $_SESSION["id_utente"] = $row["id_utente"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["ruolo"] = $row["ruolo"];

        header("Location: ../pages/areaUtente.php");
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