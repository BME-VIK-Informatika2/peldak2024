<?php
require 'lib/helpers.php';

$db = connectDatabase();

$errors = [];
// Vevő mentése
if (!empty($_POST)) {

    if ($_POST['action'] == 'create') {
        $vevo_nev = $_POST['nev'];
        $vevo_cim = $_POST['cim'] == '' ? null : $_POST['cim'];
        $vevo_telefon = $_POST['telefon'] == '' ? null : $_POST['telefon'];

        if (empty($vevo_nev)) {
            $errors['nev'] = 'A név megadása kötelező!';
        }

        if ($vevo_telefon !== null) {
            $vevo_telefon = str_replace([' ', '-'], '', $vevo_telefon);
            if (!preg_match('/^(\+36|06)(20|30|70)[0-9]{7}$/', $vevo_telefon)) {
                $errors['telefon'] = 'Hibás telefonszám formátum!';
            }
        }

        if (empty($errors)) {
            $statement = $db->prepare('INSERT INTO vevok (nev, cim, telefon) VALUES (:nev, :cim, :telefon)');
            $statement->bindParam('nev', $vevo_nev, PDO::PARAM_STR);
            $statement->bindParam('cim', $vevo_cim, PDO::PARAM_STR);
            $statement->bindParam('telefon', $vevo_telefon, PDO::PARAM_STR);
            $statement->execute();
            $statement->closeCursor();

            unset($vevo_nev, $vevo_cim, $vevo_telefon);
            $status = 'Sikeres mentés!';
        } else {
            $status = 'Sikertelen mentés!';
        }

    } elseif ($_POST['action'] == 'delete') {
        $vevo_id = $_POST['vevo'];

        if (empty($vevo_id)) {
            $status = $errors['vevo'] = 'Nincs megadva vevő!';
        }

        $statement = $db->prepare('SELECT COUNT(m.id) db FROM vevok v LEFT JOIN megrendelesek m on v.id = m.vevo_id WHERE v.id = :id GROUP BY v.id ');
        $statement->bindParam('id', $vevo_id, PDO::PARAM_INT);
        $statement->execute();

        if ($statement->rowCount() == 0) {
            $status = $errors['vevo'] = 'Nincs ilyen vevő!';
        } else if ($statement->fetchColumn() > 0) {
            $status = $errors['vevo'] = 'A vevő nem törölhető, mert tartozik hozzá megrendelés!';
        }

        $statement->closeCursor();

        if(empty($errors)){
            $statement = $db->prepare('DELETE FROM vevok WHERE id = :id');
            $statement->bindParam('id', $vevo_id, PDO::PARAM_INT);
            $statement->execute();
            $statement->closeCursor();
            $status = 'Sikeres törlés!';
        }

    }
}

$query = "SELECT v.id, v.nev, v.cim, v.telefon, COUNT(m.id) db FROM vevok v
            LEFT JOIN megrendelesek m ON m.vevo_id = v.id
            GROUP BY v.id";
$result = $db->query($query);
$vevok = $result->fetchAll(PDO::FETCH_OBJ);
$result->closeCursor();
unset($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Webshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Webshop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Főoldal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="termekek.php">Termékek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="vevok.php">Vevők</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="megrendelesek.php">Megrendelések</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">

    <?php if (isset($status)): ?>
        <div class="alert alert-<?= empty($errors) ? 'success' : 'danger' ?>">
            <?= $status ?>
        </div>
    <?php endif; ?>

    <h1>Vevők</h1>
    <hr class="col-1 my-4">

    <table class="table border-bottom-2">
        <tr>
            <th>#</th>
            <th>Név</th>
            <th>Cím</th>
            <th>Rendelések száma</th>
            <th>Törlés</th>
        </tr>

        <tbody class="table-group-divider">
        <?php foreach ($vevok as $vevo): ?>
            <tr>
                <td><?= $vevo->id ?></td>
                <td><?= $vevo->nev ?></td>
                <td><?= $vevo->cim ?></td>
                <td><?= $vevo->telefon ?></td>
                <td><?= $vevo->db ?></td>
                <?php if ($vevo->db == 0): ?>
                    <td>
                    <form method="post">
                        <input type="hidden" name="vevo" value="<?= $vevo->id ?>">
                        <button type="submit" name="action" class="btn btn-link py-0" value="delete">Törlés</button>
                    </form>
                <?php else: ?>
                    <td></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>

    <h1>Új vevő hozzáadása</h1>
    <hr class="col-1 my-4">
    <form method="POST">
        <div class="mb-3">
            <label for="nev" class="form-label">Név</label>
            <input type="text" class="form-control" id="nev" name="nev"
                   value="<?= $vevo_nev ?? '' ?>"
                   required>
            <?php if (isset($errors['nev'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['nev'] ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="cim" class="form-label">Cím</label>
            <input type="text" class="form-control" id="cim" name="cim"
                   value="<?= $vevo_cim ?? '' ?>">
            <?php if (isset($errors['cim'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['cim'] ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="telefon" class="form-label">Telefon</label>
            <input type="text" class="form-control" id="telefon" name="telefon"
                   value="<?= $vevo_telefon ?? '' ?>">
            <?php if (isset($errors['telefon'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['telefon'] ?>
                </div>
            <?php endif; ?>
        </div>
        <button type="submit" name="action" class="btn btn-primary" value="create">Hozzáadás</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>