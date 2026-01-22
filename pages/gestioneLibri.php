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
        <title> Gestione Libri - Biblioteca Incenso Verde</title>
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

            
            <?php
            if(isset($_SESSION["id_utente"])){

                if($_SESSION["ruolo"]=="admin"){
                    
                    echo "<div class='cell' onclick='cambiaPagina(`gestioneUtenti.php`)'> Gestione Utenti </div>";
                    
                }

                echo "<div class='cell' onclick='cambiaPagina(`areaUtente.php`)'> Area Utente </div>";
                echo " <form action='../php/logout.php' method='POST'>
                         <div class='cell'> <button type='submit' id='logoutButton'> Logout </button> </div>
                        </form> ";
                } 
            ?>
        </div>
        <!-- FINE NAVBAR -->

        <!-- Aggiungi libro -->
            <div class="crea">
                <h2>Aggiungi un nuovo libro</h2>
                <form action="../php/aggiungiLibri.php" method="POST">
                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" required>

                    <label for="titolo">Titolo:</label>
                    <input type="text" id="titolo" name="titolo" required>

                    <label for="autore">Autore:</label>
                    <input type="text" id="autore" name="autore" required>

                    <label for="genere">Genere:</label>
                    <input type="text" id="genere" name="genere" required>

                    <label for="prezzo">Prezzo Noleggio (al mese):</label>
                    <input type="number" step="0.01" id="prezzo" name="prezzo" required>

                    <input type="submit" value="Aggiungi Libro">
                </form>
            </div>
            <!-- FINE Aggiungi libro -->

        <!-- CONTENUTO PAGINA -->
         <div class="content">
            <?php

                include("../php/connessioneDatabase.php");

                // Gestione aggiornamento prezzo
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['isbn']) && isset($_POST['prezzo'])) {
                    $isbn = $_POST['isbn'];
                    $prezzo = $_POST['prezzo'];
                    
                    $updateQuery = "UPDATE libri SET prezzo = $prezzo WHERE isbn='$isbn'";
                    
                    if (mysqli_query($conn, $updateQuery)) {
                        header('Location: gestioneLibri.php');
                        exit();
                    } else {
                        echo 'Errore durante l\'aggiornamento del prezzo: ' . mysqli_error($conn);
                    }
                }

                $query = "SELECT `isbn`, `titolo`, `autore`, `genere`, `quantita`, `prezzo`, `data_aggiunta` FROM `libri`";

                $result = $conn->query($query);

                // Controllo se ci sono risultati e li stampo in una tabella
                if ($result->num_rows > 0) {
                    echo "<table border='1'>
                            <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Titolo</th>
                                <th>Autore</th>
                                <th>Genere</th>
                                <th>Quantità</th>
                                <th> Prezzo Noleggio <br> (al mese) </th>
                                <th> Data Aggiunta </th>
                                <th> </th>
                                <th> </th>
                            </tr>
                            </thead>";
                    // Stampa dei dati di ogni riga
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["isbn"]. "</td>
                                <td>" . $row["titolo"]. "</td>
                                <td>" . $row["autore"]. "</td>
                                <td>" . $row["genere"]. "</td>
                                <td>" . $row["quantita"]. "</td>
                                <td>" . $row["data_aggiunta"]. "</td>
                                <td> <form  method='POST'>
                                        <input type='hidden' name='isbn' value='" . $row["isbn"] . "'>
                                        <input type='number' step='0.01' name='prezzo' value='" . $row["prezzo"] . "' required>
                                        <input type='submit' class='saveButton' value='Salva'>
                                     </form>
                                </td>";
                                echo "<td>
                                <td> <form action='../php/eliminaLibro.php' method='POST'>
                                        <input type='hidden' name='isbn' value='" . $row["isbn"] . "'>
                                        <input type='submit' class='cancelButton' value=''>
                                     </form> </td>
                                </tr>";
                    }
                    echo "</table>";
                } 
                $conn->close();
            ?>
            <!-- Bottone per aggiungere un libro -->
             <input type="button" value="Aggiungi Libro"  id="aggiungi" onclick="$('.crea').show(); $('.content').hide();" >    
            <!-- FINE CONTENUTO PAGINA -->
        </div>
        
    </body>
</html>