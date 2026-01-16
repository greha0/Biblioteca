<?php
    session_start();
    include("../php/connessioneDatabase.php");

    // Recupero dell'ISBN del libro da eliminare
    $isbn = $_POST["isbn"] ?? null;

    // Query di eliminazione

    $query = "DELETE FROM libri WHERE isbn='$isbn'";

    // Controllo se la quantità è maggiore di 1
    $checkQuery = "SELECT quantita FROM libri WHERE isbn='$isbn'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        $row = $checkResult->fetch_assoc();
        if ($row['quantita'] > 1) {
            // Decremento la quantità di 1
            $decrementQuery = "UPDATE libri SET quantita = quantita - 1 WHERE isbn='$isbn'";
            if (mysqli_query($conn, $decrementQuery)) {
                header("Location: ../pages/gestioneLibri.php");
                exit;
            } else {
                header("Location: ../pages/gestioneLibri.php?error=decrement_failed");
                exit;
            }
        }
    }

    if (mysqli_query($conn, $query)) {
        header("Location: ../pages/gestioneLibri.php");
        exit;
    } else {
        header("Location: ../pages/gestioneLibri.php?error=delete_failed");
        exit;
    }
?>