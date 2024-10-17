<?php
require '../helpers.php';
/*
 * Vezérlő utasítások
 */

// if
$nap = "kedd";
if ($nap == "hétfő") {
    println("A hét első napja");
} elseif ($nap == "szombat" || $nap == "vasárnap") {
    println("Hétvége");
} else {
    println("Hétköznap");
}

// switch
$nap = "kedd";
switch ($nap) {
    case "hétfő":
        println("A hét első napja");
        break;
    case "szombat":
    case "vasárnap":
        println("Hétvége");
        break;
    default:
        println("Hétköznap");
        break;
}

// while
$i = 0;
while ($i < 10) {
    println($i++);
}

// do-while
$i = 0;
do {
    println($i++);
} while ($i < 10);

// for
for ($i = 0; $i < 10; $i++) {
    println($i);
}

// foreach
$array = ['name' => 'John', 'city' => 'London', 'date' => 1990];
foreach ($array as $key => $value) {
    println("$key: $value");
}
