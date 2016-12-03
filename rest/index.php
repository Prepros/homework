<?php
require_once 'config.php';
$root = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

// Убираем с uri /lesson 8/
$uri = str_replace('/rest/', '', $_SERVER['REQUEST_URI']);

// Если не api/v1 (2..n)
if (!preg_match('|api/v(\d+)|', $uri)) {
    echo "<a href='api/v1/products'>Перейти к api Products</a><br>";
    echo "<a href='api/v1/categories'>Перейти к api Category</a><br>";
    exit('Этой не апи');
}

// Получаем номер версии api
$version = preg_replace('|api/v(\d+)/*.*|', '$1', $uri);

// Получаем параметры апи
$uri = preg_replace('|api/v\d+/(\w+)|', '$1', $uri);
if (!empty($uri)) {
    // Ищем вопросительный вопрос в uri
    if (preg_match('|\?|', $uri)) {
        // Если находим убираем его и все, что после него
        $uri = substr($uri, 0, strpos($uri, '?'));
    }
    $params = explode('/', trim($uri, '/'));
}
//print_r($params); exit;
if (empty($params)) {
    exit('Ошибка: пустая api строка');
}

// Определяем класс и значение
foreach ($params as $key => $val) {
    if ($key % 2 == 0) {
        $class = $val; // например products
    } else {
        $param = $val; // например 1 (id)
    }
}

// Проверяем файл с классом на существование
$class_file = 'class/' . ucfirst($class) . '.php';
if (!file_exists($class_file)) {
    exit('Ошибка: файл - ' . $class_file . ' не найден!');
}

// Подключаем файл с классом
require_once $class_file;
$class_obj = new $class;

ob_start();
// Проверяем метод запроса
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': // получить
        echo "GET запрос: <br>";
        if (empty($param)) {
            $class_obj->index(); // Все данные
        } else {
            $class_obj->show($param); // Только по указанному id
        }
        break;
    case 'POST': // создать
        $class_obj->store();
        break;
    case 'PUT': // изменить
        $put = file_get_contents('php://input');
        $class_obj->edit($put);
        break;
    case 'DELETE': // удалить
        $put = file_get_contents('php://input');
        $class_obj->destroy($put);
        break;
}

// Получаем все id категорий
$categories = Category::all()->toArray();

// Выводим страницу
require_once 'index.html';

echo ob_get_clean();