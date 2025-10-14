<html>
    <head>
         <link rel="icon" type="image/x-icon" href="examples/logo.png">
        <title> Registrazione - Biblioteca </title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>

        <div class="navbar"> 
            <p id="navTitle"> Biblioteca </p>
        </div>

        <form action="index.php" method="POST">

            <span><label>Username: </label>
            <input type="text" name="username"></span> 
            <span><label> Password: </label>
            <input type="password" name="password"></span>
            <input type="submit">

        </form>
    </body>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = ""; //bXHG8p!!4BM9Ngx
        $dbname = "i5ai3";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if($conn->connect_error){
            die("Connessione fallita: " + $conn->connect_error);
        } else {
            echo("Connesso al server<br>");
        }

        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $data_nascita = $_POST["data_nascita"];
        $luogo_nascita = $_POST["luogo_nascita"];
        $codice_fiscale = $_POST["codice_fiscale"];
        $numero_telefono = $_POST["numero_telefono"];

        
        $username = $_POST["username"];
        $data_creazione = date('Y-m-d');

        $query = "INSERT INTO persona (nome, cognome, data_nascita, luogo_nascita, codice_fiscale, numero_telefono) VALUES ('$nome' , '$cognome', '$data_nascita' , '$luogo_nascita' , '$codice_fiscale' , '$numero_telefono')";
        echo $query;
        if (mysqli_query($conn, $query)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);

    ?>
</html>