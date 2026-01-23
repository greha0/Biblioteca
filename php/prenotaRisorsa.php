<?php
    session_start();
    // Se l'utente non è loggato, reindirizza alla pagina di login
    if(!isset($_SESSION["id_utente"])){
        header("Location: login.php");
        exit;
    }

    include(__DIR__ . "/connessioneDatabase.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Recupera l'ID utente dalla sessione
        $id_utente = $_SESSION["id_utente"];

        // Recupera l'array dei codici delle risorse selezionate
        $risorseSelezionate = isset($_POST['selezionati']) ? $_POST['selezionati'] : array();

        // Recupera la data di scadenza della prenotazione
        $dataScadenza = date('Y-m-d', strtotime($_POST['data_scadenza'] ?? ''));

// Normalizza: se arriva una stringa trasformala in array
        if(!is_array($risorseSelezionate)){
            $risorseSelezionate = array($risorseSelezionate);
        }
        $risorseSelezionate = array_values(array_filter($risorseSelezionate, function($v){
            return $v !== null && $v !== '';
        }));

        // Divido l'array in libri e film (ora i valori sono "L:id" o "F:id")
        $libri = array();
        $film = array();
        foreach($risorseSelezionate as $risorsa){
            if(strpos($risorsa, ':') !== false){
                list($type, $id) = explode(':', $risorsa, 2);
                $id = intval($id);
                if($type === 'L'){
                    $libri[] = $id;
                } elseif($type === 'F'){
                    $film[] = $id;
                }
            } else {
                // retrocompatibilità: valore numerico => libro
                if(is_numeric($risorsa)) $libri[] = intval($risorsa);
            }
        }

        // Calcolo mesi di noleggio
        $dataOggi = new DateTime();
        $dataScadenzaObj = new DateTime($dataScadenza);
        $intervallo = $dataOggi->diff($dataScadenzaObj);
        $mesiNoleggio = ($intervallo->y * 12) + $intervallo->m;
        if($intervallo->d > 0) $mesiNoleggio += 1;

        // Contatori debug
        $inseriti = 0;

        // Inserisco le prenotazioni per i libri (uno per ogni libroID)
        foreach($libri as $libroID){
            $libroID = intval($libroID);
            $q = "SELECT prezzo FROM libri WHERE libroID = $libroID LIMIT 1";
            $prezzoResult = mysqli_query($conn, $q);
            if(!$prezzoResult || mysqli_num_rows($prezzoResult) == 0){
                error_log("prenotaRisorsa: libro non trovato per libroID $libroID - " . mysqli_error($conn));
                continue;
            }
            $row = mysqli_fetch_assoc($prezzoResult);
            $prezzo = floatval($row['prezzo']);
            $costo = $mesiNoleggio * $prezzo;

            $insertQuery = "INSERT INTO `noleggi` (`id_utente`, `data_noleggio`, `data_scadenza`, `prezzo`, `libro`, `film`)
                            VALUES ('$id_utente', NOW(), '$dataScadenza', $costo, $libroID, NULL)";
            if(mysqli_query($conn, $insertQuery)){
                $inseriti++;
            } else {
                error_log("prenotaRisorsa: errore insert per libroID $libroID - " . mysqli_error($conn));
            }
        }

        // Inserisco le prenotazioni per i film (uno per ogni filmID)
        foreach($film as $filmID){
            $filmID = intval($filmID);
            $qf = "SELECT prezzo FROM film WHERE filmID = $filmID LIMIT 1";
            $rf = mysqli_query($conn, $qf);
            if(!$rf || mysqli_num_rows($rf) == 0){
                error_log("prenotaRisorsa: film non trovato per filmID $filmID - " . mysqli_error($conn));
                continue;
            }
            $rowf = mysqli_fetch_assoc($rf);
            $prezzo = floatval($rowf['prezzo']);
            $costo = $mesiNoleggio * $prezzo;

            $insertQuery = "INSERT INTO `noleggi` (`id_utente`, `data_noleggio`, `data_scadenza`, `prezzo`, `libro`, `film`)
                            VALUES ('$id_utente', NOW(), '$dataScadenza', $costo, NULL, $filmID)";
            if(mysqli_query($conn, $insertQuery)){
                $inseriti++;
            } else {
                error_log("prenotaRisorsa: errore insert per filmID $filmID - " . mysqli_error($conn));
            }
        }

        // Dopo l'inserimento reindirizza alla pagina delle prenotazioni
        header("Location: ../pages/prenota.php");
        exit();

    }
?>