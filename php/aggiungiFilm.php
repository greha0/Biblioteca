<?php
    session_start();
    include("../php/connessioneDatabase.php");

    // Recupero dei dati dal form
    $isan = $_POST["isan"] ?? null;
    $titolo = $_POST["titolo"] ?? null;
    $autore = $_POST["autore"] ?? null;
    $genere = $_POST["genere"] ?? null;
    $quantita = $_POST["quantita"] ?? null;
    $prezzo = $_POST["prezzo"] ?? null;

    //Controllo che non esista già un film con lo stesso ISAN
    $checkQuery = "SELECT isan FROM film WHERE isan='$isan'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        //Aggiungo  alla quantita di libri esistenti
        $addQuery = "UPDATE film SET quantita = quantita + $quantita WHERE isan='$isan'";
        if (mysqli_query($conn, $addQuery)) {
            header("Location: ../pages/gestioneFilm.php");
            exit;
        } else {
            header("Location: ../pages/gestioneFilm.php?error=update_failed");
            exit;
        }
    }else{
        // Inserimento del nuovo film nel database
        $query = "INSERT INTO film (isan, titolo, autore, genere, prezzo) VALUES ('$isan', '$titolo', '$autore', '$genere', $prezzo)";
        if (mysqli_query($conn, $query)) {
            header("Location: ../pages/gestioneFilm.php");
            exit;
        } else {
            header("Location: ../pages/gestioneFilm.php?error=insert_failed");
            exit;
        }
    }
    mysqli_close($conn);
?>