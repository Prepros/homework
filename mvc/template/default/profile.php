<table>
    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <?php if (!empty($ava)):?>
                            <img width="200" src="<?=$path_img.$ava;?>" alt="">
                        <?php else: ?>
                            <img width="200" src="http://0.gravatar.com/avatar/?d=http://jensovet.org/ava/mystery_foto.png&s=50" alt="">
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </td>
        <td style="vertical-align: top;">
            <table>
                <tr><td><strong>id:</strong> <?=$id;?></td></tr>
                <tr><td><strong>Логин:</strong> <?=$login;?></td></tr>
                <tr><td><strong>Пароль:</strong> <?=$password;?></td></tr>
                <tr><td><strong>Имя:</strong> <?=$name;?></td></tr>
                <tr><td><strong>Возраст:</strong> <?=$age;?></td></tr>
                <tr><td><strong>Обо мне:</strong><br> <?=$about;?></td></tr>
            </table>
        </td>
    </tr>
</table>
<nav>
    <a href="<?=$web;?>profile/addphoto">Добавить фото</a> |
    <a href="<?=$web;?>profile/photos">Просмотреть все загруженные файлы</a> |
    <a href="<?=$web;?>users">Просмотреть всех зарегистрированных пользователей</a> |
    <a href="<?=$web;?>profile/exit">Выйти</a>
</nav>