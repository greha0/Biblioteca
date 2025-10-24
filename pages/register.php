<html>
    <head>
         <link rel="icon" type="image/x-icon" href="../img/logo.png">
         <script src="../jquery-3.7.1.min.js"></script>
         <script src="../js/script.js"></script>
        <title> Registrazione - Biblioteca </title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/navbarStyle.css">
    </head>
    <body>

        <div class="navbar"> 
            <p id="navTitle"> Biblioteca </p>
            <div id="menuIcon" onclick="slideBarra()"> </div>
        </div>
        <div class="slideBar">
            <div class="cell" onclick="cambiaPagina('../index.php')"> Homepage </div>
            <div class="cell" onclick="cambiaPagina('../pages/login.php')">  Area Utente </div>
            <div class="cell"> Amministratore </div>
        </div>

        <form action="../php/register.php" method="POST">

            <span>
                <label>Username: </label>
                <input type="text" name="username">
            </span>
            <span>
                <label> Nome: </label>
                <input type="text" name="nome">
            </span>
            <span>
                <label> Cognome: </label>
                <input type="text" name="cognome">
            </span>
            <span>
                <label> Data di nascita: </label>
                <input type="date" name="data_nascita">
            </span>
            <span>
                <label> Luogo di nascita: </label>
                <input type="text" name="luogo_nascita">
            </span>
            <span>
                <label> Codice fiscale: </label>
                <input type="text" name="codice_fiscale">
            </span>
            <span>
                <label> Numero di telefono: </label>
                <input type="text" name="numero_telefono">
            </span>
            <span>
                <label> Password: </label>
                <input type="password" name="password">
            </span>
            <span>
                <button type="submit">Registrati</button>
            </span>
            
            <p id="login" onClick="cambiaPagina('login.php')"> Hai già un account? </p>

        </form>
    </body>

    
</html>