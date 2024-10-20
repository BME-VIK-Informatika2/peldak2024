<?php

/*
 * CSV exportálás
 */

// Adatok
$data = [
    ["name" => "Sándor", "age" => 50, "city" => "Budapest"],
    ["name" => "József", "age" => 40, "city" => "Szeged"],
    ["name" => "Benedek", "age" => 30, "city" => "Debrecen"],
];

// Kimenet típusának beállítása
header('Content-Type: text/csv');

// Kimenet nevének beállítása
header('Content-Disposition: attachment; filename="export.csv"');

// Fejléc kiírása
echo implode(",", array_keys($data[0])) . "\n";

// Szöveg kiírása
foreach ($data as $row) {
    echo implode(",", array_values($row)) . "\n";
}