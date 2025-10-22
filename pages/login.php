<html>
    <head>
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
        <title> Login - Biblioteca </title>
        <link rel="stylesheet" href="../css/style.css">
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
            <div class="cell" onclick="cambiaPagina('../pages/login.php')">  Area Utente </div>
            <div class="cell"> Amministratore </div>
        </div>


        <form action="login.php" method="POST" style="height:40dvh">

            <span><label>Username: </label>
            <input type="text" name="username" maxlength="64"></span> 
            <span><label> Password: </label>
            <input type="password" name="password" maxlength="64"></span>
            <input type="submit">
            <p id="login" onClick="cambiaPagina('register.php')"> Non hai ancora un account? </p>

        </form>
    </body>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "bXHG8p!!4BM9Ngx"; 
        $dbname = "i5ai3";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if($conn->connect_error){
            die("Connessione fallita: " + $conn->connect_error);
        } else {
            echo("Connesso al server<br>");
        }

        
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT `descrizione`, `password` FROM `utente` WHERE descrizione='$username'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            //Controllo la password
            if(strcmp($row["password"], $password)==0){
                echo "Accesso effetuato";
                echo "<script>
                        window.location.replace('userpage.php');
                      </script>
                     ";
            } else {
                echo "Password errata";
            }
            } else {
            echo "0 results";
        }

        mysqli_close($conn);
    ?>

</html>