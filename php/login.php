<?php
        session_start();
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

        
        $username = $_POST["username"];
        $password = $_POST["password"];


        $query = "SELECT `descrizione`, `password`, `id_persona`  FROM `utente` WHERE descrizione='$username'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            //Controllo la password
            if(strcmp($row["password"], $password)==0){
                echo "Accesso effetuato";
                $_SESSION["id_persona"] = $row["id_persona"];
                header("Location: ../pages/areaUtente.php");
            } else {
                echo "Password errata";
            }
            } else {
            echo "0 results";
        }

        mysqli_close($conn);
    ?>