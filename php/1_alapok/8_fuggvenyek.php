<?php
require '../helpers.php';
/*
 * Függvények
 */

// Függvény deklaráció
function hello() {
    println("Hello, world!");
}
hello(); // Hello, world!

// Visszatérési érték
function add($a, $b) {
    return $a + $b;
}
println(add(2, 3)); // 5

// Alapértelmezett paraméterek
function greet($name = "John") {
    println("Hello, $name!");
}
greet(); // Hello, John!
greet("Jane"); // Hello, Jane!

// Opcionális típus megadás
function greet2(string $name = "John"):string {
    return "Hello, $name!";
}

// Referencia szerinti átadás
function increment(&$a) {
    $a++;
}
$a = 5;
increment($a);
println($a); // 6

// Változó számú paraméter
function sum(...$numbers) {
    $sum = 0;
    foreach ($numbers as $number) {
        $sum += $number;
    }
    return $sum;
}
println(sum(1, 2, 3)); // 6
println(sum(1, 2, 3, 4, 5)); // 15

// Rekurzió
function factorial($n) {
    if ($n == 0) {
        return 1;
    }
    return $n * factorial($n - 1);
}
println(factorial(5)); // 120

// Lambda függvények
$add = function($a, $b) {
    return $a + $b;
};

// Arrow függvények
$substract = fn($a, $b) => $a - $b;

// Függvény mint paraméter
function greet3(Callable $printer){
    $printer("Hello, world!");
}

// Függvény átadása paraméterként
greet3(fn($message) => println($message)); // Hello, world!
greet3(function($message){
    println($message);
}); // Hello, world!
greet3('println'); // Hello, world!

// Statikus változók
function counter() {
    static $count = 0;
    return $count++;
}

println(counter()); // 0
println(counter()); // 1
println(counter()); // 2
