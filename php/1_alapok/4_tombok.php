<?php
require '../helpers.php';
/*
 * Tömbök
 */

// Indexelt tömbök
// Létrehozás
$array = array('string', 12, false);
$array = ['string', 12, false];
println($array);

// Beszúrás
$array[] = 'következő';
$array[10] = 10;
$array[-1] = 'negatív';
println($array);

// Hivatkozás
println($array[3]); // következő

// Törlés
unset($array[10]);
println($array);
unset($array);

// Asszociatív tömbök
// Létrehozás
$array = array('név' => 'Ferenc', 'kor' => 31, 'házas' => true);
$array = ['név' => 'Ferenc', 'kor' => 31, 'házas' => true];
println($array);

// Beszúrás
$array['város'] = 'Budapest';
$array[10] = 10;
$array['született'] = [1993, 10, 25]; // Tömb a tömbben
println($array);

// Hivatkozás
println($array['név']); // Ferenc

// Törlés
unset($array['város']);
println($array);
unset($array);

// Utasítások
$indxd = [2, 3, 1, 4, 5];
$assoc = ['b' => 3, 'a' => 2, 'c' => 1];

// darabszám
println(count($indxd)); // 5

// ellenőrzés
println(in_array(3, $indxd)); // true
println(in_array(1, $assoc)); // true
println(array_key_exists('a', $assoc)); // true

// törlés/beszúrás
println(array_pop($indxd)); // 5
array_push($indxd, 6);
println($indxd); // [2, 3, 1, 4, 6]

// sorrend megfordítás
println(array_reverse($indxd)); // [6, 4, 1, 3, 2]

// rendezés (indexelt)
sort($indxd);
println($indxd); // [1, 2, 3, 4, 6]
rsort($indxd);
println($indxd); // [6, 4, 3, 2, 1]

// rendezés (asszociatív)
asort($assoc);
println($assoc); // ['c' => 1, 'a' => 2, 'b' => 3]
arsort($assoc);
println($assoc); // ['b' => 3, 'a' => 2, 'c' => 1]
ksort($assoc);
println($assoc); // ['a' => 2, 'b' => 3, 'c' => 1]
krsort($assoc);
println($assoc); // ['c' => 1, 'b' => 3, 'a' => 2]





