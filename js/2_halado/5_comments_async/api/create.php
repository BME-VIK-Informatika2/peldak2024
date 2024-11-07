<?php

header("Content-Type: application/json");

// Hibakezelés
$errors = [];

// Ha van POST kérés (tömb nem üres)
if (!empty($_POST)) {

    // Kapcsolódás az adatbázishoz
    try {
        $db = new PDO("mysql:host=localhost;dbname=info2;charset=utf8mb4", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Failed to connect: ' . $e->getMessage()]);
        http_response_code(500);
        exit;
    }

    // Név ellenőrzése
    if (empty($_POST['author'])) {
        $errors['author'] = 'The name is required!';
    } else if (strlen($_POST['author']) > 50) {
        $errors['author'] = 'The name is too long!';
    }

    // Comment ellenőrzése
    if (empty($_POST['comment'])) {
        $errors['comment'] = 'The comment is required!';
    }

    // Ha nincs hiba
    if (empty($errors)) {
        // Adatok kiolvasása
        $author = $_POST['author'];
        $comment = $_POST['comment'];

        // Prepared statement
        $statement = $db->prepare("INSERT INTO comments(author, comment) VALUES(:author, :comment)");
        $statement->bindParam(':author', $author, PDO::PARAM_STR);
        $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
        $result = $statement->execute();

        if ($result) {
            // Sikeres beszúrás
            echo json_encode(['data' => 'The comment has been added!']);
            exit;
        }
    }

    // Hiba esetén JSON válasz
    echo json_encode(['error' => 'The comment cannot be added!', 'fields' => $errors]);
    http_response_code(422);
    exit;
}

echo json_encode(['error' => 'No data!']);
http_response_code(400);
exit;