<?php
namespace app\core;

class Config
{
    // Для работы с БД
    public $dbhost = 'localhost';
    public $dbname = 'lesson5';
    public $dbuser = 'root';
    public $dbpass = '';

    // Пути к различным каталогам проекта
    public $path = array(
        'core' => 'app/core/',
        'controllers' => 'app/controllers/',
        'models' => 'app/models/',
        'template' => 'template/default/',
        'upload' => 'upload/'
    );
    
    public $mail = array(
        'myAddress' => 'serzh.loftskul@yandex.ru',
        'myPass' => 'fdh436'
    );

    public $reCaptcha = array(
        'secret' => '6LctwQwUAAAAANxCrtI6PUGM5fvtTkQsLrLI3p-5'
    );

    // Переводим путь до запрашиваемого класса в путь, используемый в namespace
    // app/controller => app\controller
    public function getNameSpace($name, $path = 'core')
    {
        $namespace = str_replace('/', '\\', $this->path[$path]) . $name;
        return $namespace;
    }

    // Получаем путь до корневой папки
    public function getRoot()
    {
        return str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
    }

    // Получаем путь до корневой ссылки сайта
    public function getWebRoot()
    {
        return str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    }
}