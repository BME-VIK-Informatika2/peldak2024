<?php
require '../helpers.php';
/*
 * Fájlkezelés
 */

// Elérési útvonalak
$path = '7_fajlkezeles/lorem.txt';
println(basename($path));
println(dirname($path));
println(realpath($path));

// Könyvtárak
$path = '7_fajlkezeles';
println(is_dir($path));
println(scandir($path));
println(glob($path . '/*.csv'));

mkdir('7_fajlkezeles/test');
rmdir('7_fajlkezeles/test');

// Fájlok
$path = '7_fajlkezeles/lorem.txt';
println(file_exists($path));
println(is_file($path));

copy($path, '7_fajlkezeles/lorem_copy.txt');
rename('7_fajlkezeles/lorem_copy.txt', '7_fajlkezeles/lorem_renamed.txt');
unlink('7_fajlkezeles/lorem_renamed.txt');

// Tárhely
println(disk_free_space('.'));
println(disk_total_space('.'));

// Bináris fájlok
$path = '7_fajlkezeles/image.jpg';
println(filesize($path));
println(mime_content_type($path));

// Képek
$path = '7_fajlkezeles/image.jpg';
$image = getimagesize($path);
println($image);

// Szöveges fájl teljes tartalmának beolvasása
$path = '7_fajlkezeles/lorem.txt';
$f = fopen($path, 'r');
$content = fread($f, filesize($path));
println($content);
fclose($f);

// Fájl soronkénti beolvasása
$path = '7_fajlkezeles/lorem.txt';
$f = fopen($path, 'r');
while ($line = fgets($f)) {
    println($line);
}
fclose($f);

// Fájl karakterenkénti beolvasása
$path = '7_fajlkezeles/lorem.txt';
$f = fopen($path, 'r');
while ($char = fgetc($f)) {
    println($char);
}
fclose($f);

// Fájl írása
$path = '7_fajlkezeles/test.txt';
$f = fopen($path, 'w');
fwrite($f, 'Hello, world!' . PHP_EOL);
fclose($f);

// Fájl hozzáfűzése
$path = '7_fajlkezeles/test.txt';
$f = fopen($path, 'a');
fwrite($f, 'Hello, world, again!' . PHP_EOL);
fclose($f);

// JSON fájl olvasása
$path = '7_fajlkezeles/people.json';
$json = file_get_contents($path);
$data = json_decode($json, true);
println($data);

// JSON fájl írása
$path = '7_fajlkezeles/countries.json';
$data = [
    ['name' => 'Hungary', 'continent' => 'Europe', 'area' => 93030],
    ['name' => 'USA', 'continent' => 'America', 'area' => 9372610],
    ['name' => 'China', 'continent' => 'Asia', 'area' => 9706961]
];
$json = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents($path, $json);

// CSV fájl olvasása
$path = '7_fajlkezeles/cities.csv';
$f = fopen($path, 'r');
$head = fgetcsv($f);
println($head);
while ($row = fgetcsv($f, null, ',')) {
    println($row);
}
fclose($f);

// CSV fájl írása
$path = '7_fajlkezeles/movies.csv';
$header = ['name', 'year', 'genre'];
$data = [
    ['name' => 'Inception', 'year' => 2010, 'genre' => 'Sci-Fi'],
    ['name' => 'Interstellar', 'year' => 2014, 'genre' => 'Sci-Fi'],
    ['name' => 'The Dark Knight', 'year' => 2008, 'genre' => 'Action'],
];
$f = fopen($path, 'w');
fputcsv($f, $header);
foreach ($data as $row) {
    fputcsv($f, $row);
}
fclose($f);





