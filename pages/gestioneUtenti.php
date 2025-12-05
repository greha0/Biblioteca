<html>
    <head>
        <link rel="stylesheet" href="../css/navbarStyle.css">
        <link rel="stylesheet" href="../css/gestioneUtentiStyle.css">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
        <script src="../jquery-3.7.1.min.js"></script>
        <script src="../js/script.js"></script>
        <title> Gestione Utenti - Biblioteca Incenso Verde </title>
    </head>
    <body>
        <!-- NAVBAR -->
        <div class="navbar"> 
            <p id="navTitle"> Biblioteca </p>
            <div id="menuIcon" onclick="slideBarra()"> </div>
        </div>
        <div class="slideBar">
            <div class="cell" onclick="cambiaPagina('../index.php')" > Homepage </div>
            <div class="cell" onclick="cambiaPagina('areaUtente.php')" id="areaUtente">  Area Utente </div>
            <div class='cell' onclick="cambiaPagina('gestioneLibri.php')"> Gestione Libri </div>
            <div class='cell' onclick="cambiaPagina('gestioneFilm.php')"> Gestione Film </div>
            <div class='cell' onclick="cambiaPagina('gestioneUtenti.php')"> Gestione Utenti </div>
                <form action='../php/logout.php' method='POST'>
                    <div class='cell'> <button type='submit' id="logoutButton"> Logout </button> </div>
                </form>
            </div>
        <!-- FINE NAVBAR -->

        <!-- Form per creare un nuovo bibliotecario -->
            <div class="creaBibliotecario">
                <h2> Crea un nuovo bibliotecario </h2>
                <form action="../php/creaBibliotecario.php" method="POST">
                    <label for="cf"> Codice Fiscale: </label>
                    <input type="text" id="cf" name="cf" required><br><br>

                    <label for="username"> Username: </label>
                    <input type="text" id="username" name="username" required><br><br>

                    <label for="password"> Password: </label>
                    <input type="password" id="password" name="password" required><br><br>

                    <label for="nome"> Nome: </label>
                    <input type="text" id="nome" name="nome" required><br><br>

                    <label for="cognome"> Cognome: </label>
                    <input type="text" id="cognome" name="cognome" required><br><br>

                    <label for="tel"> Telefono: </label>
                    <input type="text" id="tel" name="tel" required><br><br>

                    <label for="data_nascita"> Data di Nascita: </label>
                    <input type="date" id="data_nascita" name="data_nascita" required><br><br>

                    <label for="luogo_nascita"> Luogo di Nascita: </label>
                    <input type="text" id="luogo_nascita" name="luogo_nascita" required><br><br>

                    <label for="email"> Email: </label>
                    <input type="email" id="email" name="email" required><br><br>

                    <input type="submit" value="Crea Bibliotecario">
                </form>
            </div>
        <!-- Fine form per creare un nuovo bibliotecario -->

            <!-- Tabella di visualizzazione utenti -->
            <?php
            $servername = "mariadb";
            $username = "i5ai3";
            $passwordDb = "password";
            $dbname = "i5ai3";

            $conn = new mysqli($servername, $username, $passwordDb, $dbname);

            if($conn->connect_error){
                die;
            }

            $query = "SELECT u.username, u.ruolo, p.cf, p.nome, p.cognome, p.tel, p.data_nascita, p.luogo_nascita, p.email FROM persone p INNER JOIN utenti u ON p.cf = u.cf"; 

            //JOIN tra persone e utenti
            $result = mysqli_query($conn, $query) or die("Invalid query"); 
            
            echo "<div class='content'>
                    <table>
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Ruolo</th>
                        <th>Codice Fiscale</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Telefono</th>
                        <th>Data di Nascita</th>
                        <th>Luogo di Nascita</th>
                        <th>Email</th>
                        <th> Modifica ruolo </th>
                    </tr>
                    </thead>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['ruolo'] . "</td>";
                echo "<td>" . $row['cf'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['cognome'] . "</td>";
                echo "<td>" . $row['tel'] . "</td>";
                echo "<td>" . $row['data_nascita'] . "</td>";
                echo "<td>" . $row['luogo_nascita'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td> 
                        <form action='../php/modificaBibliotecario.php' method='POST'>
                            <input type='hidden' name='cf_modifica' value='" . $row['cf'] . "'>
                            <select name='nuovo_ruolo'>
                                <option value='utente'> Utente </option>
                                <option value='bibliotecario'> Bibliotecario </option>
                                <option value='admin'> Admin </option>
                            </select>
                            <input type='submit' value='Modifica'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</table>
                  </div>";
            mysqli_close($conn); 
            ?>

            <!-- Bottone per aggiungere un bibliotecario -->
             <input type="button" value="Aggiungi Bibliotecario"  id="aggiungi" onclick="$('.creaBibliotecario').show(); $('.content').hide();" >
    </body>

    <script>
        $(document).ready(function(){
            $(".creaBibliotecario").hide();
            

            // Se clicchi sul bottone non dovrebbe chiudersi il form
            $("#aggiungi").on('click', function(e){
                e.stopPropagation();
            });

            // Se clicchi dentro il form non dovrebbe chiudersi il form
            $(".creaBibliotecario").on('click', function(e){
                e.stopPropagation();
            });
        });

        // Quando clicchi tutte le parti dello schermo tranne i form, nascondi i form
        $(document).click(function(event) {
            var target = $(event.target);
            if (!target.closest('.creaBibliotecario').length && !target.closest('#aggiungi').length) {
                $(".creaBibliotecario").hide();
                $(".content").show();
            }
        });
    </script>
</html>