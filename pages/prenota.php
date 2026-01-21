<html>
    <head>
        <link rel="stylesheet" href="../css/navbarStyle.css">
        <link rel="stylesheet" href="../css/visualizzazioneStyle.css">
        <link rel="stylesheet" href="../css/prenotaStyle.css">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
        <script src="../jquery-3.7.1.min.js"></script>
        <script src="../js/script.js"></script>
        <title> Prenota Risorsa - Biblioteca Incenso Verde</title>
    </head>
    <body>
        <!-- NAVBAR -->
        <div class="navbar"> 
            <p id="navTitle"> Biblioteca </p>
            <div id="menuIcon" onclick="slideBarra()"> </div>
        </div>
        <div class="slideBar">
            <div class="cell" onclick="cambiaPagina('../index.php')"> Homepage </div>
            <div class="cell" onclick="cambiaPagina('visualizzaLibri.php')"> Esplora i libri </div>
            <div class="cell" onclick="cambiaPagina('visualizzaFilm.php')"> Esplora i film </div>
        </div>
        <!-- FINE NAVBAR -->

        <!-- CONTENUTO PAGINA -->
         <div class="content">
            <h2> Prenota una risorsa </h2>
            <!-- Visualizzazione dei libri e film con check box con possibilità di filtrarli -->
            <div class="filtro">
                <h3> Filtra per: </h3>
                <form action="prenota.php" method="GET">
                <label for="genere">Genere:</label>
                <select id="genere" name="genere">
                    <option value="">Tutti</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="giallo">Giallo</option>
                    <option value="storico">Storico</option>
                    <option value="horror">Horror</option>
                    <option value="commedia">Commedia</option>
                </select>

                <!-- Film o Libro -->
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo">
                    <option value="">Entrambi</option>
                    <option value="libro">Libro</option>
                    <option value="film">Film</option>
                </select>

                <label for="autore">Autore:</label>
                <input type="text" id="autore" name="autore" placeholder="Nome autore">

                <button type="submit">Applica Filtro</button>
                </form>
            </div>
            <div id="risorseContainer">
                <!-- Visualizzazioni delle risorse filtrate -->
                 <?php
                    include("../php/connessioneDatabase.php");
                    $query = "SELECT titolo, autore, genere, prezzo, isbn AS codice, quantita, 'Libro' AS tipo 
                    FROM libri
                    UNION
                    SELECT titolo, autore, genere, prezzo, isan AS codice, quantita, 'Film' AS tipo 
                    FROM film";  
                    // Visualizzazione della query in tabella e checkbox
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        echo "<form action='../php/prenotaRisorsa.php' method='POST'>";
                        echo "<table border='1'>
                                <thead>
                                <tr>
                                    <th>Seleziona</th>
                                    <th>Tipo</th>
                                    <th>Titolo</th>
                                    <th>Autore</th>
                                    <th>Genere</th>
                                    <th>Prezzo</th>
                                    <th>Quantità Disponibile</th>
                                </tr>
                                </thead>
                                <tbody>";
                        while($row = $result->fetch_assoc()) {
                            $tipo = $row["tipo"];
                            echo "<tr>
                                    <td><input type='checkbox' name='selezionati[]' value='" . $row["codice"] . "'></td>
                                    <td>" . $tipo . "</td>
                                    <td>" . $row["titolo"] . "</td>
                                    <td>" . $row["autore"] . "</td>
                                    <td>" . $row["genere"] . "</td>
                                    <td>" . $row["prezzo"] . " €</td>
                                    <td>" . $row["quantita"] . "</td>
                                  </tr>";
                        }
                        echo "</tbody></table>";
                        echo "<button type='submit'>Prenota Risorse Selezionate</button>";
                        echo "</form>";
                    } else {
                        echo "Nessuna risorsa trovata.";
                    }
                ?>

        </div>
    </body>
</html>