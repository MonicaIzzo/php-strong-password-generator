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
require __DIR__ . '/includes/utils/functions.php';



if (isset($_GET['length'])) {
    // Controllo se posso utilizzare i duplicati
    $duplicates_allowed = $_GET['duplicates'] ? true : false;

    // Controllo i caratteri che puoi usare
    $allowed_characters = $_GET['characters'] ?? [];


    // Genero la password
    $result = generate_password($_GET['length'], $duplicates_allowed, $allowed_characters);

    // Se la password è stata settata, mando alla pagina success.php
    if ($result === true) header('Location: success.php');
    //! errore
    $error = $result;
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
                <?php if (isset($error)) : ?>
                    <div class="col-7">
                        <div class="alert alert-danger">
                            La tua password è: <strong><?= $error ?></strong>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-7">
                    <form class="p-3 border border-1 rounded-2 bg-light" action="index.php" method="GET">

                        <!--Lunghezza Password-->
                        <div class="row mb-3">
                            <label for="length" class="col-sm-7 col-form-label">Lunghezza password:</label>
                            <div class="col-sm-3">
                                <input type="number" name="length" id="length" class="form-control" <?php if (isset($error)) echo 'is-invalid' ?> value="<?= $_GET['length'] ?? 8 ?>" step="1">
                            </div>
                        </div>

                        <!--Ripetizioni Caratteri -->
                        <fildset class="row mn-3">
                            <legend class="col-form-label col-sm-7 pt-0">Consenti ripetizioni di uno o più carateri:</legend>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="duplicates" id="allow-duplicates" checked value="1">
                                    <label class="form-check-label" for="allow-duplicates">SI</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="duplicates" id="prevent-duplicates" value="0">
                                    <label class="form-check-label" for="prevent-duolicates">NO</label>
                                </div>
                            </div>
                        </fildset>

                        <!--Tipologia Caratteri ammessi -->
                        <div class="row mb-3 mt-5">
                            <div class="col-sm-5 offset-sm-7">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="characters[]" id="letters" checked value="L">
                                    <label class="form-check-label" for="letters">Lettere</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="characters[]" id="numbers" checked value="N">
                                    <label class="form-check-label" for="numbers">Numeri</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="characters[]" id="symbols" checked value="S">
                                    <label class="form-check-label" for="symbols">Simboli</label>
                                </div>
                            </div>

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