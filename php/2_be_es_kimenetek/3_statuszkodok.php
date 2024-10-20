<?php

/*
 * Státuszkódok
 */

$user = 'guest';

// Átirányítás
if(!isset($user)) {
    header('Location: /php/2_be_es_kimenetek');
    exit;
}

// Jogosultság megtagadása
if($user == 'guest') {
    http_response_code(403);
    exit('403 Forbidden: Ez az oldal vendégeknek nem elérhető!');
}

// Tartalom nem található
if($user != 'admin') {
    http_response_code(404);
    exit('404 Not Found: Felhasználó nem található!');
}

echo 'Hello, admin!';





