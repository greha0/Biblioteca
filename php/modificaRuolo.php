<?php
    session_start();
    include("../php/connessioneDatabase.php");

    // Recupero del codice fiscale dell'utente da eliminare
    $codice_fiscale = $_POST["cf_elimina"] ?? null;

    // Recupero del nuovo ruolo
    $nuovo_ruolo = $_POST["nuovo_ruolo"] ?? null;

    // Query di modifica ruolo
    $query = "UPDATE utenti SET ruolo = $nuovo_ruolo WHERE cf='$codice_fiscale'";
    if($codice_fiscale == $_SESSION["cf"]){
        header("Location: ../pages/gestioneUtenti.php?error=cannot_modify_self");
        exit;
    }

    if (mysqli_query($conn, $query)) {
        header("Location: ../pages/gestioneUtenti.php");
        exit;
    } else {
        header("Location: ../pages/gestioneUtenti.php?error=modify_failed");
        exit;
    }
?>