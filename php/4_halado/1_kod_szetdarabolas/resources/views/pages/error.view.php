<?php
/** @var int $errorCode */
/** @var string $errorTitle */
/** @var string $errorMessage */
?>
<h1>Hiba történt!</h1>
<h2><?= $errorCode ?> - <?= $errorTitle ?></h2>
<div class="col-lg-8 px-0">
    <p class="fs-5"><?= $errorMessage ?></p>
    <hr class="col-1 my-4">

    <a href="<?= route('/') ?>">Vissza a főoldalra</a>
</div>
