<?php

/*
 * Egyszerű API
 */

// Adatok
$data = [
    ["name" => "Sándor", "age" => 50, "city" => "Budapest"],
    ["name" => "József", "age" => 40, "city" => "Szeged"],
    ["name" => "Benedek", "age" => 30, "city" => "Debrecen"],
];

// Kimenet típusának beállítása
header('Content-Type: application/json');

// Fejléc kiírása
echo json_encode($data);