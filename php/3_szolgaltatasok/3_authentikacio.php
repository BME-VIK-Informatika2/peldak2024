<?php

require '../helpers.php';

$user = "user";
$pass = "pass";

// Regisztráció
$hash = password_hash($pass, PASSWORD_DEFAULT);
println($hash); //$2y$10$LMz99M0EOPw8LeiolGtEm.eYfg2Qlwyeq/ArO9rY2/zZ/Xieh8zv.

// Bejelentkezés
if (password_verify($pass, $hash)) {
    println("Sikeres bejelentkezés");
} else {
    println("Sikertelen bejelentkezés");
}

// Bearer token ellenőrzés
$headers = getallheaders();
$auth = $headers['Authorization'] ?? '';

preg_match('/Bearer (.+)/', $auth, $matches);
if (!empty($matches)) {
    $token = $matches[1];
    echo "Megadott token: " . $token;
} else {
    echo "Nincs token megadva!";
}