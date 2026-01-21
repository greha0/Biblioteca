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
                    echo "<div class='cell' onclick='cambiaPagina(`prenota.php`)'> Esplora i libri </div>
                        <div class='cell' onclick='cambiaPagina(`prenota.php`)'> Esplora i film </div>";
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
            <br><br>
            Qui potrai gestire le tue prenotazioni, visualizzare lo storico dei tuoi noleggi e modificare le tue informazioni personali.

            Coming soon...
        </div>
    </body>

    
</html>
