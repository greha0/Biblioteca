<?php
session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="../css/navbarStyle.css">
        <link rel="stylesheet" href="../css/visualizzazioneStyle.css">
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
            <?php
            if(isset($_SESSION["id_utente"])){

                if($_SESSION["ruolo"]=="utente"){
                    //possibilità di noleggio
                    //display film con opzione noleggio bottone
                    echo "<div class='cell' onclick='cambiaPagina(`visualizzaLibri.php`)'> Esplora i libri </div>
                        <div class='cell' onclick='cambiaPagina(`visualizzaFilm.php`)'> Esplora i film </div>";
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
            // Parametri di connessione al database
            $servername = "localhost";
            $username = "root";
            $passwordDb = "";
            $dbname = "i5ai3-test";

            $query = "SELECT `isan`, `titolo`, `autore`, `genere` FROM `film`";

            // Creazione connessione
            $conn = new mysqli($servername, $username, $passwordDb, $dbname);

            // Controllo connessione
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

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
                        </tr>
                        </thead>";
                // Stampa dei dati di ogni riga
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["isan"]. "</td>
                            <td>" . $row["titolo"]. "</td>
                            <td>" . $row["autore"]. "</td>
                            <td>" . $row["genere"]. "</td>
                          </tr>";
                }
                echo "</table>";
            } 
            $conn->close();
            ?>
        </div>
        <!-- FINE CONTENUTO PAGINA -->
    </body>
</html>