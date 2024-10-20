<?php
require '../helpers.php';

/*
 * Szuperglobális változók
 */

// Fontosabb $_SERVER paraméterek
println("Fájl név: " . $_SERVER['SCRIPT_FILENAME']); // Fájl név: .../2_be_es_kimenetek/1_szuperglobalis_valtozok.php
println("Szerver neve: " . $_SERVER['SERVER_NAME']); // Szerver neve: localhost
println("Szerver portja: " . $_SERVER['SERVER_PORT']); // Szerver portja: 80
println("Kérés típusa: " . $_SERVER['REQUEST_METHOD']); // Kérés típusa: GET
println("Query string: " . $_SERVER['QUERY_STRING']); // Query string: nev=Info2&kod=VIAUAC10

// Összes $_SERVER paraméter listázása
//foreach ($_SERVER as $key => $value) {
//    println("SERVER $key: $value");
//}

// $_GET paraméterek listázása
if (count($_GET)) {
    foreach ($_GET as $key => $value) {
        println("GET $key: $value");
    }
} else {
    println("Nincs GET paraméter");
}

// $_GET paraméter teszteléséhez link
echo '<br><br><a href="?nev=Info2&kod=VIAUAC10">Katt ide!</a><br>' . "\n";

if(isset($_GET['nev']) || isset($_GET['demo'])){
    println($_GET['nev']);
    println($_GET['kod']);
}