<?php
session_start();
?>

<?php
        if(isset($_SESSION["id_persona"])){
            header("Location: ../index.php");
        }
    ?>
<html>
    <head>
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
        <title> Login - Biblioteca </title>
        <link rel="stylesheet" href="../css/formStyle.css">
        <link rel="stylesheet" href="../css/navbarStyle.css">
        <script src="../jquery-3.7.1.min.js"></script>
        <script src="../js/script.js"></script>
    </head>
    <body>
        <div class="navbar"> 
            <p id="navTitle"> Biblioteca </p>
            <div id="menuIcon" onclick="slideBarra()"> </div>
        </div>
        <div class="slideBar">
            <div class="cell" onclick="cambiaPagina('../index.php')"> Homepage </div>
            <div class="cell" onclick="cambiaPagina('login.php')">  Area Utente </div>
        </div>



        <form action="../php/login.php" method="POST" style="height:40dvh">

            <span><label>Username: </label>
            <input type="text" name="username" maxlength="64"></span> 
            <span><label> Password: </label>
            <input type="password" name="password" maxlength="64"></span>
            <button type="submit"> Accedi </button>
            <p id="login" onClick="cambiaPagina('register.php')"> Non hai ancora un account? </p>
        </form>
    </body>
    
</html>