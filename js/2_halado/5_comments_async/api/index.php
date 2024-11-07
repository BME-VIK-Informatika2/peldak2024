<?php

// Kapcsolódás az adatbázishoz
try {
    $db = new PDO("mysql:host=localhost;dbname=info2;charset=utf8mb4", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to connect: ' . $e->getMessage()]);
    http_response_code(500);
    exit;
}

// Összes elem lekérdezése
$allItems = $db->query("SELECT * FROM comments")->fetchAll(PDO::FETCH_ASSOC);
$result = ['data' => $allItems];

// Eredmény kiíratása
header("Content-Type: application/json");
echo json_encode($result);
exit;
