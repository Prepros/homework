<table width="100%" border="1">
    <tr style="font-weight: bold;">
        <td>Имя:</td>
        <td>Возраст:</td>
        <td>Описание:</td>
        <td>Допуск:</td>
    </tr>
<? foreach ($params['users'] as $user) : ?>
    <tr>
        <td><?=$user['name'];?></td>
        <td><?=$user['age'];?></td>
        <td><?=$user['about'];?></td>
        <td><?=$user['dopusk'];?></td>
    </tr>
<? endforeach; ?>
</table>
<br>
<a href="<?=$web;?>profile">В профайл</a>