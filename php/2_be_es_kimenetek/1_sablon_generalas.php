<?php $var = 'world'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP</title>
</head>
<body>
    <!-- Sablon generálás -->
    <?php echo "<h1>Hello, $var</h1>"; ?>

    <!-- Tetszőleges számú php block -->
    <?php
    if ($var == 'world') {
        echo "<h1>Hello, $var</h1>";
    } else {
        echo "<h1>Welcome, $var</h1>";
    }
    ?>

    <!-- Generálás előtt a sablon nem biztos, hogy szintaktikailag helyes -->
    <?php $color = 'red'; ?>
    <h2 style="color: <?php echo $color ?>">
        Ennek a szövegnek a színe dinamikusan változhat.
    </h2>

    <!-- Kiíratás rövidített forma -->
    <h3 style="color: <?= $color ?>">Hello, <?= $var ?></h3>

    <!-- If alternatív formája -->
    <?php if ($var == 'world'): ?>
        <h1>Hello, <?= $var ?></h1>
    <?php else: ?>
        <h1>Welcome, <?= $var ?></h1>
    <?php endif; ?>

    <!-- Alternatív formával komplex html sablon generálható -->
    <?php $array = ["Név" => "Informatika 2", "Tárgykód" => "VIAUAC10", "Kredit" => 5, "Követelmények" => "3/0/1/f"]; ?>
    <table border="1">
        <?php foreach ($array as $key => $value): ?>
            <tr>
                <th style="background: lightgray; padding: 3px; text-align: right"><?= $key ?>:</th>
                <td style="padding: 3px; text-align: left"><?= $value ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>