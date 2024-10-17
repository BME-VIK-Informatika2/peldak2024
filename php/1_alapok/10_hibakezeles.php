<?php
require '../helpers.php';
/*
 * Hibakezelés
 */

function divide($a, $b)
{
    if ($b == 0)
        throw new Exception("Nullával nem lehet osztani!");
    return $a / $b;
}

// divide(5, 0);
// PHP Fatal error:  Uncaught Exception: Nullával nem lehet osztani!

// try-catch
try {
    divide(5, 0);
} catch (Exception $e) {
    println("Hiba: " . $e->getMessage());
    // Hiba: Nullával nem lehet osztani!
}

// try-catch-finally
try {
    divide(5, 0);
} catch (Exception) {
} finally {
    println("Vége a programnak!");
    // Vége a programnak!
}