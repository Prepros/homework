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
<h2>Форма авторизации:</h2>
<p><?=$_SESSION['message']; unset($_SESSION['message']);?></p>
<form method="POST">
    <label>
        <h3>Логин:</h3>
        <input type="text" name="login" placeholder="Введите логин" required>
    </label>
    <label>
        <h3>Пароль:</h3>
        <input type="password" name="password" placeholder="Введите пароль" required>
    </label>
    <input type="submit" name="authorization" value="Авторизоваться">
    <p>Если у Вас еще нет аккаунта, Вы можете <a href="index.php?view=registration">зарегистрироваться</a>.</p>
</form>
</body>
</html>