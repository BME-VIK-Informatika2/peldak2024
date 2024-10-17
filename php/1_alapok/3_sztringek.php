<?php
require '../helpers.php';
/*
 * Sztringek
 */

// Szimpla idézőjel
println('Hello!'); // Hello!
println('Escape: \' \\'); // Escape: ' \

// Dupla idézőjel
println("Hello!"); // Hello!
println("Escape: \", \\, \$, \n ...");
/* Escape: ", \, $,
 ... */

// Interpoláció
$name = "world";
println("Hello, $name!"); // Hello, world!
println("Hello, {$name}s!"); // Hello, worlds!

$inputs = ['name' => 'world'];
println("Hello, {$inputs['name']}!"); // Hello, world!

// Összefűzés
println('Hello, ' . $name . '!'); // Hello, world!

// Utasítások
$string = "Hello, world!";
println($string[0]); // H
println(substr($string, 0, 5)); // Hello
println(strlen($string)); // 13
println(strpos($string, "world")); // 7
println(str_replace("world", "php", $string)); // Hello, php!
println(sprintf("Hello, %s!", "world")); // Hello, world!
println(strtoupper($string)); // HELLO, WORLD!
println(strtolower($string)); // hello, world!
println(trim("  Hello, world!  ")); // Hello, world!
println(explode(" ", $string)); // ['Hello', 'world!']
println(implode(" ", ["Hello,", "world!"])); // Hello, world!















