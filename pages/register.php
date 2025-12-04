<html>
    <head>
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
        <script src="../jquery-3.7.1.min.js"></script>
        <script src="../js/script.js"></script>
        <title> Registrazione - Biblioteca Incenso Verde </title>
        <link rel="stylesheet" href="../css/formStyle.css">
        <link rel="stylesheet" href="../css/navbarStyle.css">
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

        <!-- Form di registrazione -->
        <form action="../php/register.php" method="POST">
        <h1> Registrati </h1>
        <span class="error"> 
            <?php
            // Errori di registrazione
             if (isset($_GET['error'])){
                echo "<style> .error { display: block; } </style>";
                if($_GET['error'] == 'cf_exists'){
                    echo ("Errore nella registrazione: Codice fiscale già esistente.");
                    }
                if($_GET['error'] == 'email'){
                    echo ("Errore nella registrazione: Formato email non valido.");
                }
                if($_GET['error'] == 'numero_telefono'){
                    echo ("Errore nella registrazione: Formato numero di telefono non valido. Deve contenere esattamente 10 cifre.");
                }
                if($_GET['error'] == 'campi_vuoti'){
                    echo ("Errore nella registrazione: Compila tutti i campi.");
                }
                if($_GET['error'] == 'sql_error'){
                    echo ("Errore nella registrazione: Si è verificato un errore. Riprova più tardi.");
                }
                if($_GET['error'] == 'data_nascita'){
                    echo ("Errore nella registrazione: Data di nascita non valida.");
                }
                if($_GET['error'] == 'codice_fiscale'){
                    echo ("Errore nella registrazione: Formato codice fiscale non valido.");
                }
                if($_GET['error'] == 'username'){
                    echo ("Errore nella registrazione: Username già esistente.");
                }
                exit;
            }
            ?>
        </span>

            <span>
                <label>Username: </label>
                <input type="text" name="username" maxlength="16">
              
            </span>
            <span>
                <label> Nome: </label>
                <input type="text" name="nome" maxlength="50">
         
            </span>
            <span>
                <label> Cognome: </label>
                <input type="text" name="cognome" maxlength="50">
               
            </span>
            <span>
                <label> Data di nascita: </label>
                <input type="date" name="data_nascita" >
             
            </span>
            <span>
                <label> Luogo di nascita: </label>
                <input type="text" name="luogo_nascita" maxlength="64">
              
            </span>
            <span>
                <label> Codice fiscale: </label>
                <input type="text" name="codice_fiscale" maxlength="16">
               
            </span>
            <span>
                <label> Numero di telefono: </label>
                <input type="text" name="numero_telefono" maxlength="16"> 
            </span>

            <span>
                <label> Email: </label>
                <input type="email" name="email" maxlength="32"> 
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
        <!-- FINE Form di registrazione -->
    </body>
</html>