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
<h2>Регистрационная форма</h2>
<form method="POST" enctype="multipart/form-data">
    <div class="box">
        <label>
            <h3>Логин: *</h3>
            <input type="text" name="login" placeholder="Введите логин" value="prepros" required>
        </label>
        <label>
            <h3>Пароль: *</h3>
            <input type="password" name="password" placeholder="Введите пароль" value="123456" required>
        </label>
        <label>
            <h3>Имя:</h3>
            <input type="text" name="name" placeholder="Введите имя" value="Сергей">
        </label>
        <label>
            <h3>Возраст:</h3>
            <input type="text" name="age" placeholder="Введите возраст" value="25">
        </label>
        <label>
            <h3>Описание о себе:</h3>
            <textarea name="about" rows="10" placeholder="Введите описание о себе">Некоторая инфа о мне</textarea>
        </label>
        <label>
            <h3>Фото:</h3>
            <input type="file" name="photo" placeholder="Загрузите свое фото">
        </label>
        <input type="submit" name="registration" value="Зарегистрироваться">
    </div>
</form>
</body>
</html>
