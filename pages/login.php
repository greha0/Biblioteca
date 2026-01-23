<?php
session_start();
?>

<?php
// Se l'utente è già loggato, reindirizza alla sua area utente
        if(isset($_SESSION["id_utente"])){
            header("Location: areaUtente.php");
            exit;
        }
?>
<html>
    <head>
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
        <title> Login - Biblioteca Incenso Verde </title>
        <link rel="stylesheet" href="../css/formStyle.css">
        <link rel="stylesheet" href="../css/navbarStyle.css">
        <script src="../jquery-3.7.1.min.js"></script>
        <script src="../js/script.js"></script>
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


        <!-- Form di login -->
        <form action="../php/login.php" method="POST" style="height:fit-content;">
            <h1> Accedi </h1>
            <!-- Errori di login -->
            <span class="error">
                <?php
                if (isset($_GET['error'])){
                    echo "<style> .error { display: block; } </style>";
                    if($_GET['error'] == 'password' || $_GET['error'] == 'utente'){
                        echo ("Errore nel login: Username o password errati.");
                    }
                    if($_GET['error'] == 'connessione'){
                        echo ("Errore nel login: Impossibile connettersi al database. Riprova più tardi.");
                    }
                }
                ?>
            </span>
            <!-- Fine errori di login -->

            <span><label>Username: </label>
            <input type="text" name="username" maxlength="64"></span> 
            <span><label> Password: </label>
            <input type="password" name="password" maxlength="64"></span>
            <button type="submit"> Accedi </button>
            <p id="login" onClick="cambiaPagina('register.php')"> Non hai ancora un account? </p>
        </form>
        <!-- FINE Form di login -->
    </body>
</html>