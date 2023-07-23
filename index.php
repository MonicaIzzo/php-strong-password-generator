<!--
PHP Strong Password Generator


Oggi creeremo una pagina in grado di generare una password per gli utenti.
L'utente potrà scegliere la lunghezza password e ricevere in un alert una password con il numero di caratteri casuali da lui richiesto!

Lo screen allegato è un riferimento, ma potete variare la grafica.

Milestone 1: creare un form che invii in GET la lunghezza della password.
Una nostra funzione utilizzerà questo dato per generare una password casuale
(composta da lettere, lettere maiuscole, numeri e simboli) da restituire all’utente.
Scriviamo tutto (logica e layout) in un unico file index.php

Milestone 2: verificato il corretto funzionamento del nostro codice, spostiamo la logica in un file functions.php
che includeremo poi nella pagina principale

Milestone 3: invece di visualizzare la password nella index, effettuare un redirect ad una pagina dedicata che tramite $_SESSION recupererà la password da mostrare all’utente.

Milestone 4 (BONUS): gestire ulteriori parametri per la password:
permettere o meno la ripetizione dello stesso carattere

Milestone 5 (Bonus)
Scegliere il set di caratteri tra numeri, lettere, simboli o qualsiasi combinazione di essi (anche tutti, ma almeno uno)
Milestone 6 (BONUS): Aggiungere la validazione

-->

<?php
function generate_password($length)
{

    // Preparo la mia password
    $password = '';

    // Elenco dei possibili caratteri
    $letters = 'abcdefghijklmnopqrstuwxyvz';
    $numbers = '0123456789';
    $symbols = '!?&%$<>^+-*/()]{}@#_=';

    // Combino insieme per creare tutti i caratteri disponibili
    $characters = $letters . $numbers . $symbols . strtoupper($letters);

    // Calcolo il totale dei caratteri disponibili
    $total_characters = mb_strlen($characters);

    // Generiamo la password con caratteri casuali
    while (mb_strlen($password) < $length) {
        // Prendo un index a caso
        $random_index = rand(0, $total_characters - 1);

        // Prendo un carattere a caso
        $random_character = $characters[$random_index];

        // Lo metto nella password
        $password .= $random_character;
    }
    // Restituisco la password
    return $password;
}

if (isset($_GET['length'])) {
    $password = generate_password($_GET['length']);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" content="Monica Izzo">
    <title>PHP Strong Password Generator</title>

    <!-- icon-->
    <link rel="icon" type="image/png" sizes="32x32" href="img/faicon.png">

    <!-- stylesheet -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <div class="container mb-3 pt-3">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h1 class="text-white-50">Strong Password Generator</h1>
                    <h2 class="text-white">Genera un password sicura</h2>
                </div>

                <!--Alert qui -->
                <?php if (isset($password)) : ?>
                    <div class="col-7">
                        <div class="alert alert-info">
                            La tua password è: <strong><?= $password ?></strong>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-7">
                    <form class="p-3 border border-1 rounded-2 bg-light" action="index.php" method="GET">

                        <!--Lunghezza Password-->
                        <div class="row mb-3">
                            <label for="length" class="col-sm-7 col-form-label">Lunghezza password:</label>
                            <div class="col-sm-3">
                                <input type="number" name="length" id="length" class="form-control" min="5" value="5" step="1">
                            </div>
                        </div>

                        <!--Ripetizioni Caratteri -->

                        <!--Tipologia Caratteri ammessi -->

                        <!--Bottoni -->

                        <div class="mb-3 d-flex justify-content-end">
                            <button tyoe="submit" class="btn btn-primary me-3">Invia</button>
                            <button tyoe="reset" class="btn btn-secondary">Annulla</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>