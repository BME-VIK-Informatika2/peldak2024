<?php
    // Az űrlap elküldése után a POST metódussal elküldött adatokat a $_POST tömbben kapjuk meg
    if (isset($_POST["nev"]) || isset($_POST["kod"])) {
        var_export($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP</title>
</head>
<body>

    <!-- Űrlap elküldése GET metódussal egy másik fájlnak -->
    <h1>GET</h1>
    <form action="4_szuperglobalis_valtozok.php" method="get">
        <label for="nev">Név:</label>
        <input type="text" name="nev" id="nev">
        <br>

        <label for="kod">Kód:</label>
        <input type="text" name="kod" id="kod">
        <br>

        <input type="submit" value="Küldés">
    </form>

    <!-- Űrlap elküldése POST metódussal az aktuális fájlnak -->
    <h1>POST</h1>
    <form method="post">

        <label for="nev">Név:</label>
        <input type="text" name="nev" id="nev">
        <br>

        <label for="kod">Kód:</label>
        <input type="text" name="kod" id="kod">
        <br>

        <input type="submit" value="Küldés">
    </form>

</body>
</html>