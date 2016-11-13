<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Домашнее задание №3</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            width: 550px;
            margin: 0 auto;
        }
        h3 {
            margin-bottom: 0;
        }
        p {
            font: 18px/1.6 Arial, sans-serif;
        }
        input,
        textarea {
            width: 100%;
            padding: 10px;
        }
        input[type="submit"] {
            margin-top: 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h1>Домашнее задание №3</h1>
<h2>Страница авторизированного пользователя:</h2>
<table>
    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <?php if (!empty($ava)):?>
                        <img width="300" src="<?=$photo.$ava;?>" alt="">
                        <?php else: ?>
                            <img width="300" src="data:image/jpeg;base64,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" alt="">
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
<table border="1">
    <?php if (!empty($photo_id)): ?>
    <?php foreach ($photo_id as $item): ?>
    <tr>
        <td>
            <img width="80" src="<?=$photo.$item['photo'];?>" alt="">
        </td>
        <?php if ($edit): ?>
        <td>
            <form action="index.php" method="POST">
                <input type="text" name="photo" value="<?=$item['photo'];?>">
        </td>
        <?php else: ?>
        <td><?=$item['photo'];?></td>
        <?php endif; ?>
        <?php if ($edit): ?>
        <td>
            <input type="submit" name="edit" value="Отредактировать">
            <input type="hidden" name="id" value="<?=$id;?>">
            </form>
        </td>
        <?php else: ?>
        <td><a href="index.php?edit=<?=$item['id'];?>">Редактировать</a></td>
        <?php endif; ?>
        <td><a href="index.php?delete=<?=$item['id'];?>">Удалить</a></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>
<a href="index.php?exit=1">Выйти</a>
</body>
</html>