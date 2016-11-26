<?php
namespace app\core;

class Route
{
    private static $instance; // Хранит объект данного класса
    private $routes; // Хранит массив разбитой ссылки
    private $config; // Для работы с конфигами

    // Создаем объект данного класса Singleton
    public static function getInstance()
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self;
    }

    // Отрабатывается сразу же после создания объекта данного класса
    private function __construct()
    {
        // Подключаемся к классу с конфигами
        $this->config = new Config();

        // Параметры по умолчанию
        $controller = 'Signin';
        $action = 'Index';
        $params = array();

        // Подготавливаем данные для запрошенной странице
        if (self::getUri()) {
            $controller = array_shift($this->routes);
            $action = !empty($this->routes) ? array_shift($this->routes) : $action;
            $params = !empty($this->routes) ? $this->routes : $params;
        }

        // Название контроллера
        $controller_name = ucfirst($controller) . 'Controller';
        // Название экшена данного контроллера
        $action_name = 'action' . ucfirst($action);

        // Путь до файла с подключаемым контроллером
        $controller_file = $this->config->path['controllers'] . $controller_name . '.php';

        // Ошибка 404 если запрошен не существующий контроллер
        if (!file_exists($controller_file)) {
            self::errorPage404();
        }

        // Подключаем файл контроллера
        require_once $controller_file;

        // Получаем пространство имени подключенного контроллера
        $controller_namespace = $this->config->getNameSpace($controller_name);
        // Создаем объект подключенного контроллера
        $controller_object = new $controller_namespace();

        // Ошибка 404 если запрашиваемого метода нет в подключенном контроллере
        if (!method_exists($controller_object, $action_name)) {
            self::errorPage404();
        }

        // Вызов метода и передача параметров
        // Вариант 1: Объект вызывает метод и передает параметры (массив)
         $controller_object->$action_name($params);
        // Вариант 2: Объект вызывает метод и передает параметры (переменные)
        //call_user_func_array(array($controller_object, $action_name), $params);
    }

    // Разбиваем ссылку на массив
    private function getUri()
    {
        $uri = str_replace('/mvc/', '', $_SERVER['REQUEST_URI']);

        if (!empty($uri)) {
            $this->routes = explode('/', trim($uri, '/'));
            return true;
        }

        return false;
    }

    // Страница 404
    public function errorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/mvc/';
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location:'.$host.'page404');
        exit;
    }
}
