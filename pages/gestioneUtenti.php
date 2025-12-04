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

            <div class="modificaBibliotecario">
                <h2> Modifica un bibliotecario esistente </h2>
                <form action="../php/modificaBibliotecario.php" method="POST">
                    <label for="cf_modifica"> Codice Fiscale del bibliotecario da modificare: </label>
                    <input type="text" id="cf_modifica" name="cf_modifica" required><br><br>

                    <label for="nuovo_username"> Nuovo Username: </label>
                    <input type="text" id="nuovo_username" name="nuovo_username" required><br><br>

                    <label for="nuova_password"> Nuova Password: </label>
                    <input type="password" id="nuova_password" name="nuova_password" required><br><br>

                    <label for="nuovo_telefono"> Nuovo telefono: </label>
                    <input type="text" id="nuovo_telefono" name="nuovo_telefono" required><br><br>
                    
                    <label for="nuova_email"> Nuova Email: </label>
                    <input type="email" id="nuova_email" name="nuova_email" required><br><br>

                    <label for="nuovo_ruolo"> Nuovo Ruolo: </label>
                    <select id="nuovo_ruolo" name="nuovo_ruolo" required>
                        <option value="utente"> Utente </option>
                        <option value="bibliotecario"> Bibliotecario </option>
                        <option value="admin"> Admin </option>
                    </select><br><br>

                    <input type="submit" value="Modifica Bibliotecario">
                </form>
                </div>
            <?php
            $servername = "localhost";
            $username = "root";
            $passwordDb = "bXHG8p!!4BM9Ngx";
            $dbname = "i5ai3-test";

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
                echo "</tr>";
            }
            echo "</table>
                  </div>";
            mysqli_close($conn); 
            ?>

            <!-- Bottone per aggiungere un bibliotecario -->
             <input type="button" value="Aggiungi Bibliotecario"  id="aggiungi" onclick="$('.creaBibliotecario').show(); $('.content').hide();" >
             <input type="button" value="Modifica Bibliotecario"  id="modifica" onclick="$('.modificaBibliotecario').show(); $('.content').hide();" >
    </body>

    <script>
        $(document).ready(function(){
            $(".creaBibliotecario").hide();
            $(".modificaBibliotecario").hide();

            // Prevent clicks on these elements from bubbling to document
            $("#aggiungi, #modifica").on('click', function(e){
                e.stopPropagation();
                // inline onclick already shows the forms and hides .content
            });

            // Clicking inside the forms should not close them
            $(".creaBibliotecario, .modificaBibliotecario").on('click', function(e){
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
            if (!target.closest('.modificaBibliotecario').length && !target.closest('#modifica').length) {
                $(".modificaBibliotecario").hide();
                $(".content").show();
            }
        });
    </script>
</html>