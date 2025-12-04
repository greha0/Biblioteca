<?php
session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="css/indexStyle.css">
        <link rel="stylesheet" href="css/navbarStyle.css">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        <script src="jquery-3.7.1.min.js"></script>
        <script src="js/script.js"></script>
        <title> Home - Biblioteca Incenso Verde</title>
    </head>
    <body>

    <!-- NAVBAR -->
        <div class="navbar"> 
            <p id="navTitle"> Biblioteca </p>
            <div id="menuIcon" onclick="slideBarra()"> </div>
        </div>
        <div class="slideBar">
            <div class="cell" onclick="cambiaPagina('index.php')"> Homepage </div>

            <!-- Aggiunta dinamica delle voci di menu in base al ruolo dell'utente -->
            <?php
            //se l'utente è loggato
                if(isset($_SESSION["id_utente"])){
                    //se è admin
                    if($_SESSION["ruolo"]=="admin"){
                        //aggiungo la voce di menu per la gestione utenti
                        echo "<div class='cell' onclick='cambiaPagina(`pages/gestioneUtenti.php`)'> Gestione Utenti </div>";
                        // aggiungo la voce di menu per la gestione 
                        echo "<div class='cell' onclick='cambiaPagina(`pages/gestioneLibri.php`)'> Gestione Libri </div>";
                        echo " <div class='cell' onclick='cambiaPagina(`pages/gestioneFilm.php`)'> Gestione Film </div>"; 

                    } if($_SESSION["ruolo"]=="bibliotecario"){
                        // aggiungo la voce di menu per la gestione 
                        echo "<div class='cell' onclick='cambiaPagina(`pages/gestioneLibri.php`)'> Gestione Libri </div>";
                        echo " <div class='cell' onclick='cambiaPagina(`pages/gestioneFilm.php`)'> Gestione Film </div>"; 
                    }
                    if($_SESSION["ruolo"]=="utente"){
                        //possibilità di noleggio
                        //display libri con opzione noleggio bottone
                        echo "<div class='cell' onclick='cambiaPagina(`pages/visualizzaLibri.php`)'> Esplora libri </div>
                            <div class='cell' onclick='cambiaPagina(`pages/visualizzaFilm.php`)'> Esplora film </div>";
                    }
                    
                    echo "<div class='cell' onclick='cambiaPagina(`pages/areaUtente.php`)'> Area Utente </div>";
                    echo "<form action='php/logout.php' method='POST'>
                         <div class='cell'> <button type='submit' id='logoutButton'> Logout </button> </div>
                        </form>";
                } else {
                    //se non è loggato 
                    echo "<div class='cell' onclick='cambiaPagina(`pages/visualizzaLibri.php`)'> Esplora i libri </div>
                        <div class='cell' onclick='cambiaPagina(`pages/visualizzaFilm.php`)'> Esplora i film </div>";
                }
            ?>
            <!-- Fine aggiunta dinamica -->
        </div>
        <!-- FINE NAVBAR -->

        <div class="content">
            <!-- Contenuto della pagina principale -->
             <div class="title"> Benvenuto nella biblioteca "Incensoverde"! </div>
             <div class="text"> In questa speciale biblioteca digitale potrai trovare diverse tipologie di libri, documenti, film e documentari.
                <br><br>
                Registrati o effettua il login per accedere alla tua area personale, dove potrai noleggiare libri, visualizzare lo storico delle tue letture o visioni.
                <br><br>
                Esplora la nostra vasta collezione e immergiti nel mondo della conoscenza e dell'intrattenimento!
             </div>

             <div class="buttonContainer">
                <button class="actionButton" onclick="cambiaPagina('pages/login.php')"> Accedi / Registrati </button>
                <button class="actionButton" onclick="cambiaPagina('pages/visualizzaLibri.php')"> Esplora i libri </button>
            </div>
            <footer>
                &copy; 2025 Biblioteca Incenso Verde. Tutti i diritti riservati.
            </footer>
        </div>
    </body>
</html>