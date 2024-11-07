<?php

header("Content-Type: application/json");

// ID meghatározása
if (!isset($_POST['id'])) {
    echo json_encode(['error' => 'No comment id specified!']);
    http_response_code(400);
    exit;
}
$id = $_POST['id'];

// Kapcsolódás az adatbázishoz
try {
    $db = new PDO("mysql:host=localhost;dbname=info2;charset=utf8mb4", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to connect: ' . $e->getMessage()]);
    http_response_code(500);
    exit;
}

// Adatok lekérdezése
$statement = $db->prepare("SELECT * FROM comments WHERE id = :id");
$statement->execute(['id' => $id]);
$numberOfItems = $statement->rowCount();
if ($numberOfItems === 0) {
    echo json_encode(['error' => 'No comment with the specified id!']);
    http_response_code(404);
    exit;
}

// Elem törlése
$db->prepare("UPDATE comments SET upvotes = upvotes + 1 WHERE id = :id")
    ->execute(['id' => $id]);

// Eredmény kiíratása
echo json_encode(['data' => 'The upvote has been added!']);
exit;
