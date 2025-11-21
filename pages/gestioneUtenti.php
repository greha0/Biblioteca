<html>
    <head>
        <link rel="stylesheet" href="../css/navbarStyle.css">
        <link rel="stylesheet" href="../css/tableStyle.css">
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
            <div class='cell' onclick="cambiaPagina('visualizzaLibri.php')"> Visualizza libri </div>
            <div class='cell' onclick="cambiaPagina('gestioneLibri.php')"> Gestione Libri </div>
            <div class='cell' onclick="cambiaPagina('gestioneUtenti.php')"> Gestione Utenti </div>
                <form action='../php/logout.php' method='POST'>
                    <div class='cell'> <button type='submit' id="logoutButton"> Logout </button> </div>
                </form>
            </div>
            <?php
            $servername = "mariadb";
            $username = "i5ai3";
            $passwordDb = "password";
            $dbname = "i5ai3";

            $conn = new mysqli($servername, $username, $passwordDb, $dbname);

            if($conn->connect_error){
                die("Connessione fallita: " + $conn->connect_error);
            } else {
                ;
            }

            $query = "SELECT * FROM persona"; 

            //Fare una JOIN
            $result = mysqli_query($conn, $query) or die("Invalid query"); 
            $numrows = mysqli_num_rows($result);  
            $numcols = mysqli_num_fields($result);   
            $field = mysqli_fetch_fields($result); 
            $row = mysqli_fetch_array($result);

            print "<table border=1><tr>";
            for($x=0;$x<$numcols;$x++){
            print "<th>" . $field[$x]->name . "</th>";
            }
            print "</tr>";

            while ($row = mysqli_fetch_array($result)) {
            print "<tr>";
                for ($k=0; $k<$numcols; $k++) {   
                    print "<td>" . $row[$k] . "</td>"; 
            }
            print "</tr>";
            }

            print "</table>";

            mysqli_close($conn); 
            ?>
    </body>
</html>