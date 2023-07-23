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
