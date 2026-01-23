<?php
session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="../css/navbarStyle.css">
        <link rel="stylesheet" href="../css/utenteStyle.css">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
        <script src="../jquery-3.7.1.min.js"></script>
        <script src="../js/script.js"></script>
        <title> Area Utente - Biblioteca Incenso Verde </title>
    </head>
    <body>
        <!-- NAVBAR -->
        <div class="navbar"> 
            <p id="navTitle"> Biblioteca </p>
            <div id="menuIcon" onclick="slideBarra()"> </div>
        </div>
        <div class="slideBar">
            <div class="cell" onclick="cambiaPagina('../index.php')" > Homepage </div>
            
            <?php
            if(isset($_SESSION["id_utente"])){
                if($_SESSION["ruolo"]=="admin"){
                    echo "<div class='cell' onclick='cambiaPagina(`gestioneUtenti.php`)'> Gestione Utenti </div>
                    <div class='cell' onclick='cambiaPagina(`gestioneLibri.php`)'> Gestione Libri </div>
                    <div class='cell' onclick='cambiaPagina(`gestioneFilm.php`)'> Gestione Film </div>";
                }

                if($_SESSION["ruolo"]=="bibliotecario"){
                    echo "<div class='cell' onclick='cambiaPagina(`gestioneLibri.php`)'> Gestione Libri </div>
                    <div class='cell' onclick='cambiaPagina(`gestioneFilm.php`)'> Gestione Film </div>";
                }

                if($_SESSION["ruolo"]=="utente"){
                    echo "<div class='cell' onclick='cambiaPagina(`prenota.php`)'> Prenota</div>";
                } 
            }
            ?>
                        <div class="cell" onclick="cambiaPagina('areaUtente.php')" id="areaUtente">  Area Utente </div>
                        <form action='../php/logout.php' method='POST'>
                         <div class='cell'> <button type='submit' id="logoutButton"> Logout </button> </div>
                        </form>
        </div>
        <!-- FINE NAVBAR -->
        <div class="content">
            Bentornato <?php echo $_SESSION["username"]; ?> nella tua area personale!
            <!--Visualizza qui le tue prenotazioni, modifica i tuoi dati o esplora le risorse disponibili.-->
            <div id="prenotazioniUtente">
                <h2>Le tue prenotazioni:</h2>
                <?php
                    include("../php/connessioneDatabase.php");

                    $id_utente = $_SESSION["id_utente"];

                    // Query per ottenere le prenotazioni dell'utente
                    $query = "SELECT * FROM `noleggi` WHERE id_utente = $_SESSION[id_utente]";

                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $id_utente);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo "<table border='1'>
                                <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Titolo</th>
                                    <th>Data Prenotazione</th>
                                    <th>Data Scadenza</th>
                                </tr>
                                </thead>
                                <tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['tipo']) . "</td>
                                    <td>" . htmlspecialchars($row['titolo']) . "</td>
                                    <td>" . htmlspecialchars($row['data_prenotazione']) . "</td>
                                    <td>" . htmlspecialchars($row['data_scadenza']) . "</td>
                                  </tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p>Non hai prenotazioni attive.</p>";
                    }

                    $stmt->close();
                    $conn->close();
                ?>

        </div>
    </body>

    
</html>
