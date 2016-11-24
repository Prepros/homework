<?php
namespace app\core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Eloquent
{
    protected $config; // Для работы с конфигами
    protected $func; // Для работы с функциями
    protected $capsule; // Eloquent
    
    public function __construct()
    {
        // Подключаемся к классу с конфигами
        $this->config = new Config();
        // Подключаемся к классу с функциями
        $this->func = new Functions();
        $this->capsule = new Capsule(); // Eloquent

        try {
            $this->capsule->addConnection([
                'driver'    => 'mysql',
                'host'      => $this->config->dbhost,
                'database'  => $this->config->dbname,
                'username'  => $this->config->dbuser,
                'password'  => $this->config->dbpass,
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            ]);

            $this->capsule->setAsGlobal(); // Выбираем БД по умолчанию
            $this->capsule->bootEloquent(); // Включаем БД
            throw new \Exception('Ошибка подключения к БД');
        } catch (\Exception $e) {
            $_SESSION['message'] = $e->getMessage();
        }
    }
}