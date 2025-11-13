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
        <div class="navbar"> 
            <p id="navTitle"> Biblioteca </p>
            <div id="menuIcon" onclick="slideBarra()"> </div>
        </div>
        <div class="slideBar">
            <div class="cell" onclick="cambiaPagina('index.php')"> Homepage </div>
            <div class="cell" onclick="cambiaPagina('pages/login.php')" id="areaUtente">  Area Utente </div>
            <?php
                if(isset($_SESSION["id_persona"])){
                    if($_SESSION["id_ruolo"]==1){
                        echo "<div class='cell' onclick='cambiaPagina(`pages/gestioneUtenti.php`)'> Gestione Utenti </div>
                        <div class='cell' onclick='cambiaPagina(`pages/visualizzaLibri.php`)'> Visualizza libri </div>
                        <div class='cell' onclick='cambiaPagina(`pages/gestioneLibri.php`)'> Gestione Libri </div>
                        <form action='php/logout.php' method='POST'>
                         <div class='cell'> <button type='submit' id='logoutButton'> Logout </button> </div>
                        </form>
                       <script> $('#areaUtente').attr('onclick','cambiaPagina(`pages/areaUtente.php`)'); </script>";
                    } else {
                        echo "<div class='cell' onclick='cambiaPagina(`pages/visualizzaLibri.php`)'> Visualizza libri </div>
                        <form action='php/logout.php' method='POST'>
                         <div class='cell'> <button type='submit' id='logoutButton'> Logout </button> </div>
                        </form>
                       <script> $('#areaUtente').attr('onclick','cambiaPagina(`pages/areaUtente.php`)'); </script>";
                    }
                }
            ?>
        </div>
        Home
    </body>
</html>