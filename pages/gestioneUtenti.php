<html>
    <head>
        <link rel="stylesheet" href="../css/navbarStyle.css">
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

            $servername = "localhost";
            $username = "root";
            $passwordDb = "bXHG8p!!4BM9Ngx"; //bXHG8p!!4BM9Ngx
            $dbname = "i5ai3";

            $conn = new mysqli($servername, $username, $passwordDb, $dbname);

            if($conn->connect_error){
                die("Connessione fallita: " + $conn->connect_error);
            } else {
                ;
            }

            $query = "SELECT * FROM utente"; 

            $result = mysqli_query($conn, $query) or die("Invalid query"); //Running the query and storing it in result
            $numrows = mysqli_num_rows($result);  // gets number of rows in result table
            $numcols = mysqli_num_fields($result);   // gets number of columns in result table
            $field = mysqli_fetch_fields($result); // gets the column names from the result table
            $row = mysqli_fetch_array($result);

            print "<table border=1><tr>";
            for($x=0;$x<$numcols;$x++){
            print "<th>" . $field[$x]->name . "</th>";
            }
            print "</tr>";

            while ($row = mysqli_fetch_array($result)) {   // for loop goes round until there are no rows left
            print "<tr>";
                for ($k=0; $k<$numcols; $k++) {    //  goes around until there are no columns left
                    print "<td>" . $row[$k] . "</td>"; //Prints the data
            }
            print "</tr>";
            }

            print "</table>";

            mysqli_close($con); 
            ?>
    </body>
</html>