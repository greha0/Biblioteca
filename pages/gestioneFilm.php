<?php
session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="../css/navbarStyle.css">
        <link rel="stylesheet" href="../css/visualizzazioneStyle.css">
        <link rel="stylesheet" href="../css/gestioneLibriFilm.css">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
        <script src="../jquery-3.7.1.min.js"></script>
        <script src="../js/script.js"></script>
        <title> Visualizza Film - Biblioteca Incenso Verde</title>
    </head>
    <body>
        <!-- NAVBAR -->
        <div class="navbar"> 
            <p id="navTitle"> Biblioteca </p>
            <div id="menuIcon" onclick="slideBarra()"> </div>
        </div>
        <div class="slideBar">
            <div class="cell" onclick="cambiaPagina('../index.php')"> Homepage </div>
            <div class="cell" onclick="cambiaPagina('gestioneFilm.php')"> Gestione Film </div>
            <div class="cell" onclick="cambiaPagina('gestioneLibri.php')"> Gestione Libri </div>

            <!-- Aggiungi film -->
            <div class="creaFilm">
                <h2>Aggiungi un nuovo film</h2>
                <form action="../php/aggiungiFilm.php" method="POST">
                    <label for="isan">ISAN:</label>
                    <input type="text" id="isan" name="isan" required>

                    <label for="titolo">Titolo:</label>
                    <input type="text" id="titolo" name="titolo" required>

                    <label for="autore">Autore:</label>
                    <input type="text" id="autore" name="autore" required>

                    <label for="genere">Genere:</label>
                    <input type="text" id="genere" name="genere" required>

                    <input type="submit" value="Aggiungi Film">
                </form>
            </div>
            <!-- FINE Aggiungi film -->
            <?php
            if(isset($_SESSION["id_utente"])){

                if($_SESSION["ruolo"]=="admin"){
                    
                    echo "<div class='cell' onclick='cambiaPagina(`gestioneUtenti.php`)'> Gestione Utenti </div>";
                    
                }

                echo "<div class='cell' onclick='cambiaPagina(`areaUtente.php`)'> Area Utente </div>";
                echo " <form action='../php/logout.php' method='POST'>
                         <div class='cell'> <button type='submit' id='logoutButton'> Logout </button> </div>
                        </form> ";
                } else {
                    echo "<div class='cell' onclick='cambiaPagina(`visualizzaLibri.php`)'> Esplora i libri </div>
                        <div class='cell' onclick='cambiaPagina(`visualizzaFilm.php`)'> Esplora i film </div>";
                }
            ?>
        </div>
        <!-- FINE NAVBAR -->

        <!-- CONTENUTO PAGINA -->
         <div class="content">
            <?php

                include("../php/connessioneDatabase.php");

                $query = "SELECT `isan`, `titolo`, `autore`, `genere` FROM `film`";

                $result = $conn->query($query);

                // Controllo se ci sono risultati e li stampo in una tabella
                if ($result->num_rows > 0) {
                    echo "<table border='1'>
                            <thead>
                            <tr>
                                <th>ISAN</th>
                                <th>Titolo</th>
                                <th>Autore</th>
                                <th>Genere</th>
                                <td> </td>
                            </tr>
                            </thead>";
                    // Stampa dei dati di ogni riga
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["isan"]. "</td>
                                <td>" . $row["titolo"]. "</td>
                                <td>" . $row["autore"]. "</td>
                                <td>" . $row["genere"]. "</td>
                                <td> <form action='../php/eliminaFilm.php' method='POST'>
                                        <input type='hidden' name='isan' value='" . $row["isan"] . "'>
                                        <input type='submit' class='cancelButton' value=''>
                                     </form> </td>
                            </tr>";
                    }
                    echo "</table>";
                } 
                $conn->close();
            ?>
        </div>
        <!-- Bottone per aggiungere un film -->
             <input type="button" value="Aggiungi Film"  id="aggiungi" onclick="$('.creaFilm').show(); $('.content').hide();" >    
        <!-- FINE CONTENUTO PAGINA -->
    </body>
</html>