<?php
    session_start();
    include("../php/connessioneDatabase.php");

    // Recupero del codice fiscale dell'utente da modificare
    $codice_fiscale = $_POST["cf_modifica"] ?? null;

    // Query di modifica ruolo
    $nuovo_ruolo = $_POST["nuovo_ruolo"] ?? null;

    // Eseguo l'aggiornamento nel database
    $query = "UPDATE utenti SET ruolo='$nuovo_ruolo' WHERE cf='$codice_fiscale'";

    if (mysqli_query($conn, $query)) {
        header("Location: ../pages/gestioneUtenti.php");
        exit;
    } else {
        header("Location: ../pages/gestioneUtenti.php?error=edit_failed");
        exit;
    }
?>