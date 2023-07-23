<?php

function generate_password($length, $duplicates_allowed, $allowed_characters)
{

    // Preparo la mia password
    $password = '';

    // Elenco dei possibili caratteri
    $letters = 'abcdefghijklmnopqrstuwxyvz';
    $numbers = '0123456789';
    $symbols = '!?&%$<>^+-*/()]{}@#_=';

    // Combino insieme per creare tutti i caratteri disponibili
    $characters = '';
    if (in_array('L', $allowed_characters)) $characters .= $letters . strtoupper($letters);
    if (in_array('N', $allowed_characters)) $characters .= $numbers;
    if (in_array('S', $allowed_characters)) $characters .= $symbols;

    // Calcolo il totale dei caratteri disponibili
    $total_characters = mb_strlen($characters);


    // Setto il minimo dei caratteri
    $min_length = 8;


    //! VALIDAZIONE
    if (empty($allowed_characters)) return 'Almeno un set di caratteri deve essere ammesso';
    if (empty($length)) return 'Non è stata inserita alcuna lunghezza per la password';
    elseif ($length < 0 || !is_numeric($length)) return 'Il valore inserito non è valido';
    elseif ($length < $min_length) return "La password deve essere lunga almeno $min_length caratteri";
    elseif (!$duplicates_allowed && $length > $total_characters) return "La lunghezza massima dei caratteri non deve essere superiore a $total_characters";

    // Generiamo la password con caratteri casuali
    while (mb_strlen($password) < $length) {
        // Prendo un index a caso
        $random_index = rand(0, $total_characters - 1);

        // Prendo un carattere a caso
        $random_character = $characters[$random_index];

        // Lo metto nella password (se sono ammessi duplicati)
        if ($duplicates_allowed || !str_contains($password, $random_character)) {
            $password .= $random_character;
        }
    }

    // Metto la password in sessione
    session_start();
    $_SESSION['password'] = $password;

    // Restituisco la password
    return true;
}
