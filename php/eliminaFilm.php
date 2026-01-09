<?php
    session_start();
    include("../php/connessioneDatabase.php");

    // Recupero dell'ISAN del film da eliminare
    $isan = $_POST["isan"] ?? null;

    // Query di eliminazione

    $query = "DELETE FROM film WHERE isan='$isan'";
    if($isan == $_SESSION["isan"]){
        header("Location: ../pages/gestioneFilm.php?error=cannot_delete_self");
        exit;
    }

    if (mysqli_query($conn, $query)) {
        header("Location: ../pages/gestioneFilm.php");
        exit;
    } else {
        header("Location: ../pages/gestioneFilm.php?error=delete_failed");
        exit;
    }
?>