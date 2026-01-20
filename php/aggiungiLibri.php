<?php
    session_start();
    include("../php/connessioneDatabase.php");

    // Recupero dei dati dal form
    $isbn = $_POST["isbn"] ?? null;
    $titolo = $_POST["titolo"] ?? null;
    $autore = $_POST["autore"] ?? null;
    $genere = $_POST["genere"] ?? null;
    $quantita = $_POST["quantita"] ?? null;
    $prezzo = $_POST["prezzo"] ?? null;

    //Elimino eventuali trattini dall'ISBN
    $isbn = str_replace('-', '', $isbn);

    //Controllo che non esista già un libro con lo stesso ISBN
    $checkQuery = "SELECT isbn FROM libri WHERE isbn='$isbn'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        //Aggiungo 1 alla quantita di libri esistenti
        $addQuery = "UPDATE libri SET quantita = quantita + $quantita WHERE isbn='$isbn'";
        if (mysqli_query($conn, $addQuery)) {
            header("Location: ../pages/gestioneLibri.php");
            exit;
        } else {
            header("Location: ../pages/gestioneLibri.php?error=update_failed");
            exit;
        }
    }else{
        // Inserimento del nuovo film nel database
        $query = "INSERT INTO libri (isbn, titolo, autore, genere, prezzo) VALUES ('$isbn', '$titolo', '$autore', '$genere', $prezzo)";
        if (mysqli_query($conn, $query)) {
            header("Location: ../pages/gestioneLibri.php");
            exit;
        } else {
            header("Location: ../pages/gestioneLibri.php?error=insert_failed");
            exit;
        }
    }
    mysqli_close($conn);
?>