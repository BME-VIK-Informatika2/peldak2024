<?php
/*
 * Kiemenet generálás
 */

// Egyszerű szöveg
$var = "Szöveg\n";

// Kiíratás
echo($var); // Szöveg
print($var); // Szöveg

// Zárójel elhagyható
echo $var; // Szöveg
print $var; // Szöveg

// Echo-nak lehet több paramétere
echo "Kimenet: ", $var;  // Kimenet: Szöveg
 
// Printnek van visszatérési értéke, ezért használható kifejezésben
if($result = print $var) { //Szöveg
    print "Sikeres kiírás: $result\n"; //Sikeres kiírás: 1
}

// Formázott szöveg
// szöveges behelyettesítés
$var = 'world';
printf("Hello, %s!\n", $var); // Hello, world!

// számok formázása
printf("Int: %05d, Float: %.2f, Hex: %4x, Bin: %b\n", 123,0.123,123,123);
// Int: 00123, Float: 0.12, Hex:  7b, Bin: 1111011

// HTML kimenet
printf("<h1>Hello, %s</h1>\n", $var);
// HTML: <h1>Hello, world</h1>
// Böngészőben: Hello, world

// Szimpla idézőjel, összefűzés
echo "<h1>Hello" . $var ."</h1>\n"; // <h1>Hello, world</h1>

// Dupla idézőjel, változó behelyettesítés
echo "<h1>Hello $var</h1>\n"; //<h1>Hello, world</h1>

// Karakter kódolás
echo htmlspecialchars("<h1>Hello $var</h1>");
// HTML: &lt;h1&gt;Hello, world&lt;/h1&gt;
// Böngészőben: <h1>Hello, world</h1>