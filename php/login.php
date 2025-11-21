<?php
session_start();

$servername = "mariadb";
$username = "i5ai3";
$passwordDb = "password";
$dbname = "i5ai3";

$conn = new mysqli($servername, $username, $passwordDb, $dbname);

if($conn->connect_error){
    // Meglio: mostra errore su pagina login, non qui
    header("Location: ../pages/login.php?errore=connessione");
    exit;
}

$username = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT `descrizione`, `password`, `id_persona`, `id_utente`  FROM `utente` WHERE descrizione='$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if(strcmp($row["password"], $password)==0){
        $_SESSION["id_persona"] = $row["id_persona"];
        $_SESSION["id_utente"] = $row["id_utente"];
        $ut = $_SESSION["id_utente"];
        $query = "SELECT `id_ruolo` FROM `permessi` WHERE  data_storico IN (SELECT max(data_storico) FROM `permessi`) && `id_utente` = $ut";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["id_ruolo"]=$row["id_ruolo"];
        }else{
            $_SESSION["id_ruolo"]=2;
        }
        header("Location: ../pages/areaUtente.php");
        exit;
    } else {
        header("Location: ../pages/login.php?errore=password");
        exit;
    }
} else {
    header("Location: ../pages/login.php?errore=utente");
    exit;
}

$conn->close();
?>