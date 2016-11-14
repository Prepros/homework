<?php
require_once "config.php";
require_once "function.php";

session_start();
//ini_set('default_charset','UTF-8');

// Подключаемся к БД
// Если не удалось подключитсья к БД, создаем БД и необходимые таблицы
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    $pdo = new PDO("mysql:host=$host", $dbuser, $dbpass);
    $pdo->exec("CREATE DATABASE $dbname");
    $pdo->exec("CREATE TABLE $dbname.`users` (
    `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `login` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `password` VARCHAR(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (`id`)) 
    ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT = 1
    ");
    $pdo->exec("CREATE TABLE $dbname.`users_data` (
    `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `age` TINYINT UNSIGNED NOT NULL,
    `about` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `photo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (`id`)) 
    ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT = 1
    ");
    $_SESSION['message'] = "База данных создана";
    header("Location: index.php");
    exit;
}

// Выход пользователя из системы
if ($_GET['exit'] == 1) {
    unset($_SESSION['id']);
    header("Location: index.php");
    exit;
}

// Проверка запрошеной страницы
if (!empty($_GET['view'])) {
    // Если была запрошена страница регистрации
    if($_GET['view'] == 'registration') {
        // Если пользователь нажал на кнопку Зарегистрироваться
        if (!empty($_POST['registration'])) {
            // Добавляем пользователя в БД
            try {
                $sql = 'INSERT INTO users (login, password) VALUES (:login, :password)';
                $s = $pdo->prepare($sql);
                $s->bindValue(':login', htmlout($_POST['login']));
                $s->bindValue(':password', htmlout($_POST['password']));
                $s->execute();

                $sql = 'INSERT INTO users_data (name, age, about, photo) VALUES (:name, :age, :about, :photo)';
                $s = $pdo->prepare($sql);
                $s->bindValue(':name', htmlout($_POST['name']));
                $s->bindValue(':age', htmlout($_POST['age']));
                $s->bindValue(':about', htmlout($_POST['about']));
                $s->bindValue(':photo', htmlout($_FILES['photo']['name']));
                $s->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                exit;
            }

            if (preg_match('/(jpeg|jpg|png|gif)/', $_FILES['photo']['type'])) {
                move_uploaded_file($_FILES['photo']['tmp_name'], $photo . iconv("UTF-8", "cp1251", $_FILES['photo']['name']));
            }
            // Добавляем сессию об успешной регистрации
            $_SESSION['message'] = "Поздравляем Вы успешно зарегистрировались!";

            header("Location: index.php");
            exit;
        }
        include $template . 'registration.php';
    }
} else { // Страница авторизации
    // Проверяем авторизован ли пользователь
    if (empty($_SESSION['id'])) { // Не авторизован
        // Если пользователь нажал на кнопку Авторизоваться
        if (!empty($_POST['authorization'])) {
            $sql = "SELECT id FROM users WHERE login = :login AND password = :password";
            $result = $pdo->prepare($sql);
            $result->bindValue(':login', $_POST['login']);
            $result->bindValue(':password', $_POST['password']);
            $result->execute();
            // Получаем id пользователя
            foreach ($result as $item) {
                $id = $item['id'];
            }

            // Заносим id в сессии
            $_SESSION['id'] = $id;

            if (empty($id)) {
                $_SESSION['message'] = "Неверный логин или пароль";
            }

            header("Location: index.php");
            exit;
        }
        include $template . 'authorization.php';
    } else { // Авторизован
        $sql = "SELECT * 
                FROM users 
                INNER JOIN users_data 
                ON users.id = users_data.id
                WHERE users.id = :id";
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_SESSION['id']);
        $s->execute();
        $s->setFetchMode(PDO::FETCH_ASSOC);
        foreach($s as $item) {
            $id = $item['id'];
            $login = $item['login'];
            $password = $item['password'];
            $name = $item['name'];
            $age = $item['age'];
            $about = $item['about'];
            $ava = $item['photo'];
        }

        // Массив всех картинок лежащих в папке photo
        $photo_arr = glob($photo . '*');

        foreach ($photo_arr as $item) {
            $photo_name[] = substr($item, strpos($item, '/') + 1);
        }

        $sql = "SELECT id, photo FROM users_data WHERE photo = :photo";
        $s = $pdo->prepare($sql);

        if (!empty($photo_name)) {
            foreach ($photo_name as $val) {
                $s->bindValue(':photo', $val);
                $s->execute();
                $s->setFetchMode(PDO::FETCH_ASSOC);
                foreach ($s as $it) {
                    $photo_id[] = $it;
                }
            }
        }

        $edit = false;
        // Редактирование картинок
        if (!empty($_GET['edit'])) {
            $edit = true;
            $id = (int)$_GET['edit'];
        }

        if (!empty($_POST['edit'])) {
            $sql = "SELECT photo FROM users_data WHERE id = :id";
            $s = $pdo->prepare($sql);
            $s->bindValue(':id', $_POST['id']);
            $s->execute();
            $s->setFetchMode(PDO::FETCH_ASSOC);

            // Имя файла до переименнования
            foreach ($s as $val) {
                $photo_name_old = $val['photo'];
            }

            $sql = "UPDATE users_data SET photo = :photo WHERE id = :id";
            $s = $pdo->prepare($sql);
            $s->bindValue(':photo', $_POST['photo']);
            $s->bindValue(':id', $_POST['id']);
            $s->execute();

            if (file_exists($photo.$photo_name_old)) {
                rename($photo.$photo_name_old, $photo.$_POST['photo']);
                header("Location: index.php");
                exit;
            }
        }

        // Удаление картинок
        if (!empty($_GET['delete'])) {
            $id = (int)$_GET['delete'];

            if ($id > 0 ) {
                $sql = "SELECT photo FROM users_data WHERE id = :id";
                $s = $pdo->prepare($sql);
                $s->bindValue(':id', $id);
                $s->execute();
                $s->setFetchMode(PDO::FETCH_ASSOC);

                // Имя файла до переименнования
                foreach ($s as $val) {
                    $photo_name_old = $val['photo'];
                }

                $sql = "UPDATE users_data SET photo = '' WHERE id = :id";
                $s = $pdo->prepare($sql);
                $s->bindValue(':id', $id);
                $s->execute();

                if (file_exists($photo.$photo_name_old)) {
                    unlink($photo.$photo_name_old);
                }

                header("Location: index.php");
                exit;
            }
        }

        include $template . 'user.php';
    }
}


