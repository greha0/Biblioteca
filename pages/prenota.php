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
                    
                    // Costruisci le WHERE conditions per i filtri
                    $whereConditions = "";
                    
                    if (isset($_GET['genere']) && $_GET['genere'] !== '') {
                        $genere = mysqli_real_escape_string($conn, $_GET['genere']);
                        $whereConditions .= " WHERE genere = '$genere'";
                    }
                    
                    if (isset($_GET['autore']) && $_GET['autore'] !== '') {
                        $autore = mysqli_real_escape_string($conn, $_GET['autore']);
                        if ($whereConditions === "") {
                            $whereConditions .= " WHERE autore LIKE '%$autore%'";
                        } else {
                            $whereConditions .= " AND autore LIKE '%$autore%'";
                        }
                    }
                    
                    // Determina il filtro per tipo
                    $tipoFilter = "";
                    if (isset($_GET['tipo']) && $_GET['tipo'] !== '') {
                        $tipo = $_GET['tipo'];
                        if ($tipo == 'libro') {
                            $tipoFilter = " WHERE tipo = 'Libro'";
                        } elseif ($tipo == 'film') {
                            $tipoFilter = " WHERE tipo = 'Film'";
                        }
                    }
                    
                    // Costruisci la query con i filtri inseriti nelle subquery
                    $query = "SELECT * FROM (
                        SELECT titolo, autore, genere, prezzo, isbn AS codice, quantita, 'Libro' AS tipo 
                        FROM libri $whereConditions
                        UNION
                        SELECT titolo, autore, genere, prezzo, isan AS codice, quantita, 'Film' AS tipo 
                        FROM film $whereConditions
                    ) AS risultati" . $tipoFilter;

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

                        // Determina il tipo di risorsa
                            $tipo = $row["tipo"];

                        // Stampa solo le risorse disponibili
                            if ($row["quantita"] <= 0) {
                                continue;
                            }
                            // Stampa la riga della tabella
                            echo "<tr>
                                    <td><input type='checkbox' class='checkbox-risorsa' name='selezionati[]' value='" . $row["codice"] . "' data-prezzo='" . $row["prezzo"] . "'></td>
                                    <td>" . $tipo . "</td>
                                    <td>" . $row["titolo"] . "</td>
                                    <td>" . $row["autore"] . "</td>
                                    <td>" . $row["genere"] . "</td>
                                    <td>" . $row["prezzo"] . " €</td>
                                    <td>" . $row["quantita"] . "</td>
                                  </tr>";
                        }
                        // Chiusura della tabella

                        // Aggiunta del campo data scadenza e del prezzo totale
                        echo "</tbody></table>";
                        echo "<label> Data Scadenza: </label>";
                        echo "<input type='date' name='data_scadenza' required>";
                        echo "<label> Prezzo Totale: </label>";
                        echo "<span id='prezzoTotale'>0</span> €";
                        echo "<button type='submit'> Prenota Risorse Selezionate </button>";
                        echo "</form>";
                        echo "<script>
                            $(document).ready(function() {
                                $('.checkbox-risorsa').on('change', function() {
                                    let totale = 0;
                                    $('.checkbox-risorsa:checked').each(function() {
                                        totale += parseFloat($(this).data('prezzo'));
                                    });
                                    $('#prezzoTotale').text(totale.toFixed(2));
                                });
                            });
                        </script>";
                        // Chiusura della connessione
                        mysqli_close($conn);
                    } else {
                        echo "Nessuna risorsa trovata.";
                    }
                ?>

        </div>
    </body>
</html>