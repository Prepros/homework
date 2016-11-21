<table border="1">
    <?php if (!empty($params['photo'])) : ?>
    <?php foreach ($params['photo'] as $key => $item) : ?>
        <tr>
            <td align="center" width="50px"><?=++$key;?></td>
            <td>
                <img width="200" src="<?=$web.$upload.$item;?>" alt="">
            </td>
            <td align="center"><?=$item;?></td>
        </tr>
    <?php endforeach; ?>
    <?php else : ?>
        <p>Пусто - нет файлов</p>
    <?php endif; ?>
</table>
<br>
<a href="<?=$web;?>profile">В профайл</a>