<?php
session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="css/navbarStyle.css">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        <script src="jquery-3.7.1.min.js"></script>
        <script src="js/script.js"></script>
        <title> Home </title>
    </head>
    <body>
        <div class="navbar"> 
            <p id="navTitle"> Biblioteca </p>
            <div id="menuIcon" onclick="slideBarra()"> </div>
        </div>
        <div class="slideBar">
            <div class="cell"> Homepage </div>
            <div class="cell" onclick="cambiaPagina('pages/login.php')" id="areaUtente">  Area Utente </div>
            <div class="cell"> Amministratore </div>
            <?php
                if(isset($_SESSION["id_persona"])){
                echo ("<div class='cell'> Visualizza libri </div>
                        <form action='php/logout.php' method='POST'>
                         <div class='cell'> <button type='submit'> Logout </button> </div>
                        </form>
                       <script> $('#areaUtente').attr('onclick','cambiaPagina(`index.php`)'); </script>");
                }
            ?>
        </div>
    </body>
</html>