<?php
$success = true;
$status = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $db = new PDO("mysql:host=localhost;dbname=info2", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Sikertelen kapcsolódás: ' . $e->getMessage());
    }

    if (!isset($_POST['secure'])) {
        // nem biztonságos
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password';";
        $result = $db->query($query);
    } else {
        // biztonságos
        $query = "SELECT * FROM users WHERE username = :username AND password = :password;";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt;
    }

    if ($result->rowCount()) {
        $status = 'Sikeres bejelentkezés!';
        $success = true;
    } else {
        $status = 'Felhasználó és jelszó nem megfelelő!';
        $success = false;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SQL Injection</title>
</head>
<body>
<h1>Bejelentkezés</h1>
<h2 style="color:<?= $success ? 'green' : 'red' ?>"><?= $status ?></h2>
<form method="post">
    <label for="username">Felhasználónév:</label>
    <input type="text" id="username" name="username" value="' or '1'='1">
    <br><br>
    <label for="password">Jelszó:</label>
    <input type="text" id="password" name="password" value="' or '1'='1">
    <br><br>
    <label for="secure">SQL Injection elleni védelem:</label>
    <input type="checkbox" id="secure" name="secure">
    <br><br>
    <input type="submit" value="Bejelentkezés">
</form>
</body>
</html>
