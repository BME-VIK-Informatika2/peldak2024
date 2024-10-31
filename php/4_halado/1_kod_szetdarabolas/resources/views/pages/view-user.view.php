<?php
/** @var App\Models\User $user */
?>
<h1>User #<?=$user->id?></h1>
<table class="table table-bordered">
    <tr>
        <th class="text-end w-25">Név:</th>
        <td><?=$user->first_name?> <?=$user->last_name?></td>
    </tr>
    <tr>
        <th class="text-end w-25">Nem:</th>
        <td><?=$user->gender?></td>
    </tr>
    <tr>
        <th class="text-end w-25">E-mail:</th>
        <td><?=$user->email?></td>
    </tr>
    <tr>
        <th class="text-end w-25">Város:</th>
        <td><?=$user->city?></td>
    </tr>
    <tr>
        <th class="text-end w-25">Születési dátum:</th>
        <td><?=$user->birthday?></td>
    </tr>
</table>