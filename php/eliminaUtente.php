<?php
    session_start();
    include("../php/connessioneDatabase.php");

    // Recupero del codice fiscale dell'utente da eliminare
    $codice_fiscale = $_POST["cf_elimina"] ?? null;

    // Query di eliminazione

    $query = "DELETE FROM utenti WHERE cf='$codice_fiscale'";
    if($codice_fiscale == $_SESSION["cf"]){
        header("Location: ../pages/gestioneUtenti.php?error=cannot_delete_self");
        exit;
    }

    if (mysqli_query($conn, $query)) {
        header("Location: ../pages/gestioneUtenti.php");
        exit;
    } else {
        header("Location: ../pages/gestioneUtenti.php?error=delete_failed");
        exit;
    }
?>