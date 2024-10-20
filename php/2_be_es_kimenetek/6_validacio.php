<?php
$errors = [];
$status = '';

if (!empty($_POST)) {
    $nev = '';
    $kor = '';
    $email = '';
    $image = '';

    if (empty($_POST['nev'])) {
        $errors['nev'] = "Név megadása kötelező!";
    } elseif (!preg_match('/^[A-Z][a-z]+ [A-Z][a-z]+$/', $_POST['nev'])) {
        $errors['nev'] = "Hibás név formátum!";
    } else {
        $nev = htmlspecialchars($_POST['nev']);
    }

    if (empty($_POST['kor'])) {
        $errors['kor'] = "Kor megadása kötelező!";
    } else {
        $kor = filter_var($_POST['kor'], FILTER_VALIDATE_INT, [
            'options' => [
                'min_range' => 18,
                'max_range' => 120
            ]
        ]);
        if ($kor === false) {
            $errors['kor'] = "Kor csak 18 és 120 közötti szám lehet!";
        }
    }

    if (empty($_POST['email'])) {
        $errors['email'] = "E-mail megadása kötelező!";
    } else {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            $errors['email'] = "Hibás e-mail formátum!";
        }
    }

    $file = $_FILES['image'];
    if ($file['error'] === 0) {
        if ($file['size'] > 500 * 1024) {
            $errors['image'] = 'A fájl mérete nagyobb mint 500KB!';
        } else if (!in_array($file['type'], ['image/png', 'image/jpeg'])) {
            $errors['image'] = 'A fájl csak PNG vagy JPG lehet!';
        } else {
            $absolute_path = __DIR__ . DIRECTORY_SEPARATOR . '6_validacio' . DIRECTORY_SEPARATOR . $file['name'];
            move_uploaded_file($file['tmp_name'], $absolute_path);
            $image = "/php/2_be_es_kimenetek/6_validacio/{$file['name']}";
        }
    }

    if (empty($errors)) {
        echo "Név: $nev<br>";
        echo "Kor: $kor<br>";
        echo "E-mail: $email<br>";
        if($image != ''){
            echo "Profilkép: <img src=\"$image\" alt=\"Profilkép\"/>";
        } else {
            echo "Profilkép: Nincs kép feltöltve<br>";
        }
        $status = "Az űrlap kitöltése sikeres!";
        unset($nev, $kor, $email, $image);
    } else {
        $status = "Az űrlap kitöltése nem megfelelő!";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP</title>
    <style>
        input.invalid{
            border: 1px solid red;
        }
        .error{
            color:red;
        }
        .success{
            color:green;
        }
        img{
            height: 100px;
        }
    </style>
</head>
<body>

<h1>Validáció</h1>

<?php if ($status): ?>
    <p class="<?= empty($errors) ? 'success' : 'error'?>">
        <?= $status ?>
    </p>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

    <label for="nev">Név:</label>
    <input type="text" name="nev" id="nev" value="<?= $nev ?? '' ?>"
           required pattern="[A-Z][a-z]+ [A-Z][a-z]+"
           class="<?= isset($errors['nev']) ? 'invalid' : '' ?>">
    <span class="error"><?= $errors['nev'] ?? '' ?></span>
    <br><br>

    <label for="kor">Kor:</label>
    <input type="number" name="kor" id="kor" value="<?= $kor ?? '' ?>"
           required min="18" max="120"
           class="<?= isset($errors['kor']) ? 'invalid' : '' ?>">
    <span class="error"><?= $errors['kor'] ?? '' ?></span>
    <br><br>

    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" value="<?= $email ?? '' ?>"
           required
           class="<?= isset($errors['email']) ? 'invalid' : '' ?>">
    <span class="error"><?= $errors['email'] ?? '' ?></span>
    <br><br>

    <label for="image">Profilkép:</label>
    <input type="file" name="image" id="image"
           class="<?= isset($errors['image']) ? 'invalid' : '' ?>">
    <span class="error"><?= $errors['image'] ?? '' ?></span>
    <br><br>

    <input type="submit" value="Küldés">
</form>

</body>
</html>