<?php

require '../helpers.php';

$key = 'subject';
$value = 'Info2';

// Cookie kiolvasása
$cookie = $_COOKIE[$key] ?? '';
if ($cookie == $value) {
    println("Cookie beállítva, értéke: $cookie");

    // Cookie törlése
    setcookie($key, '', time() - 3600);
} else {
    println("Cookie nincs beállítva!");

    // Cookie beállítása
    setcookie($key, $value, time() + 3600);
}

// Session elindítása
session_start();

// Session kiolvasása
$session = $_SESSION[$key] ?? '';
if ($session == $value) {
    println("Session beállítva, értéke: $session");

    // Session érték törlése
    unset($_SESSION[$key]);
    // Teljes session törlése
    session_destroy();
} else {
    println("Session nincs beállítva!");

    // Session beállítása
    $_SESSION[$key] = $value;
}


