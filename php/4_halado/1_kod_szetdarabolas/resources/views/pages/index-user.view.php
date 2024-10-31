<?php
/** @var App\Models\User[] $users */
/** @var App\Models\Paginator $paginator */
?>
<h1>Felhasználók</h1>
<table class="table">
    <tr>
        <th>#</th>
        <th>Név</th>
        <th>E-mail</th>
        <th>Művelet</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->first_name ?> <?= $user->last_name ?></td>
            <td><?= $user->email ?></td>
            <td><a href="<?=route('/user?id=' . $user->id);?>">Részletek</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include VIEWS_PATH . 'components/paginator.view.php'; ?>
