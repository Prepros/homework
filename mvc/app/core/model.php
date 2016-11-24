<?php
namespace app\core;

class Model
{
    private static $instance; // Хранит объект данного класса
    public $pdo; // Для работы с PDO
    protected $config; // Для работы с конфигами
    protected $func; // Для работы с функциями

    // Создаем объект данного класса Singleton
    public static function getInstance()
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self;
    }

    // Отрабатывается сразу же после создания объекта данного класса
    public function __construct()
    {
        // Подключаемся к классу с конфигами
        $this->config = new Config();
        // Подключаемся к классу с функциями
        $this->func = new Functions();

        // Пытаемся подключиться к БД
        try {
            $this->connectDB();
            //echo "Мы подключились к БД";
            //exit;
        } catch (\PDOException $e) {
            // В случае неудачи, создаем нужную БД
            try {
                $this->createDB();
                $this->createTableUsers();
                $this->createTableUsersData();
                $this->createTableUsersUpload();
                //echo "БД создана";
                //exit;
            } catch (\PDOException $e) {
                $_SESSION['message'] = "Ошибка создания БД: $e->getMessage()";
            }
            $_SESSION['message'] = "Ошибка подключения к БД: $e->getMessage()";
        }
    }

    // Подключаемся к БД
    private function connectDB()
    {
        $this->pdo = new \PDO("mysql:host={$this->config->dbhost};
                     dbname={$this->config->dbname}", $this->config->dbuser, $this->config->dbpass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO:: ERRMODE_EXCEPTION);
        $this->pdo->exec("SET NAMES 'utf8'");
//        $this->pdo->exec("DROP DATABASE lesson5");
    }

    // Создаем БД
    private function createDB()
    {
        $this->pdo = new \PDO("mysql:host={$this->config->dbhost}", $this->config->dbuser, $this->config->dbpass);
        $this->pdo->exec("CREATE DATABASE {$this->config->dbname}");
    }

    // Создаем таблицу с пользователями
    private function createTableUsers()
    {
        $this->pdo->exec("CREATE TABLE {$this->config->dbname}.`users` (
                        `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
                        `login` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                        `password` VARCHAR(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                        PRIMARY KEY (`id`)) 
                        ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT = 1");
    }

    // Создаем таблицу с даными пользователей
    private function createTableUsersData()
    {
        $this->pdo->exec("CREATE TABLE {$this->config->dbname}.`users_data` (
                              `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
                              `name` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                              `age` TINYINT NOT NULL,
                              `about` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                              `ava` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
                              `ip` INT NOT NULL,
                              PRIMARY KEY (`id`))
                              ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci");
    }

    // Создаем таблицу с загруженными файлами пользователей
    private function createTableUsersUpload()
    {
        $this->pdo->exec("CREATE TABLE {$this->config->dbname}.`users_upload` (
                              `id` TINYINT UNSIGNED NOT NULL,
                              `photo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL)
                              ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci");
    }
}
