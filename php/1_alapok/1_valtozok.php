<?php
require '../helpers.php';
/*
 * Változók
 */

// A változók nevei betűvel vagy alulvonással kezdődhetnek, és utána betűvel, számmal vagy alulvonással folytathatók.
$valtozo = 1;
$_valtozo = 2;
$valtozo2 = 3;
$valtozo_2 = 4;

// A változók nevei érzékennyek a kis- és nagybetűkre.
$valtozo = 1;
$VALTOZO = 2;
println($valtozo == $VALTOZO); // false

// Típusok
$v = 12; // egész szám (int)
$v = 12.5; // lebegőpontos szám (double, float)
$v = false; // logikai érték (bool)
$v = "text"; // szöveg (string)
$v = [1, 2, 3]; // tömb (array)
$v = new stdClass(); // objektum (object)
$v = null; // null

// Gyengén típusosság, futásidejű típuskiértékelés
$v = 12; // int
$v = "12"; // string

// Változók vizsgálata
println(isset($v)); // true
unset($v); // törli a változót
println(isset($v)); // false

// Típusok ellenőrzése
$v = 12;
println(gettype($v)); // integer
println(is_int($v)); // true
println(is_string($v)); // false

// Típusok beállítása
$v = "12";
println(is_int($v)); // false
println(is_string($v)); // true
settype($v, "int");
println(is_int($v)); // true
println(is_string($v)); // false
$v = (string) $v;
println(is_int($v)); // false
println(is_string($v)); // true

// Összehasonlítás
$v1 = 12;
$v2 = "12";

// Érték szerint
println($v1 == $v2); // true
println($v1 != $v2); // false

// Érték és típus szerint
println($v1 === $v2); // false
println($v1 !== $v2); // true

// Operátorok
// Aritmetikai operátorok
$v = 1 + 2; // összeadás
$v = 1 - 2; // kivonás
$v = 1 * 2; // szorzás
$v = 1 / 2; // osztás
$v = 1 % 2; // maradékos osztás
$v = 1 ** 2; // hatványozás

// Értékadó operátorok
$v = 1; // értékadás
$v += 2; // összeadás és értékadás
$v -= 2; // kivonás és értékadás
$v *= 2; // szorzás és értékadás
$v /= 2; // osztás és értékadás
$v %= 2; // maradékos osztás és értékadás
$v **= 2; // hatványozás és értékadás

// Érték növelő/csökkentő operátorok
$v = 1;
println($v++); // kiíratás, utána növelés
$v = 1;
println($v--); // kiíratás, utána csökkentés
$v = 1;
println(++$v); // növelés, utána kiíratás
$v = 1;
println(--$v); // csökkentés, utána kiíratás

// Összehasonlító operátorok
println(1 == '1'); // true
println(1 === '1'); // false

println(1 != 2); // true
println(1 !== 2); // true
println(1 <> 2); // true

println(1 < 2); // true
println(1 <= 2); // true
println(1 > 2); // false
println(1 >= 2); // false

println(1 <=> 2); // -1
println(2 <=> 2); // 0
println(2 <=> 1); // 1

// Logikai operátorok
println(true && true); // true
println(true and true); // true

println(true || false); // true
println(true or false); // true

println(true xor false); // true
println(!true); // false

// Bitenkénti operátorok
println(1 & 2); // 0
println(1 | 2); // 3
println(1 ^ 2); // 3
println(~1); // -2

// Szöveg operátorok
$v = "Hello ";
println($v . "world"); // Hello world
$v .= "world";
println($v); // Hello world

// Feltételes értékadó operátorok
$v = 5;
println($v == 5 ? "öt" : "nem öt"); // öt

$v = null;
println($v ?? "nincs érték"); // nincs érték

// Globális változók
$x = 5;
function myFunction1() {
    $x = $GLOBALS['x'];
    println($x); // 5
}
myFunction1();

function myFunction2() {
    global $x;
    println($x); // 5
}
myFunction2();














