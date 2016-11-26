<?php
namespace app\core;

use app\core\Config;
use Illuminate\Database\Capsule\Manager as Capsule;

class Model extends Capsule
{
    public $capsule;
    protected $config;

    // Подключаемся к БД чере Eloquent
    public function __construct()
    {
        $this->config = new Config;
        $this->capsule = new Capsule;

        $this->capsule->addConnection([
            'driver'    => $this->config->db['driver'],
            'host'      => $this->config->db['host'],
            'database'  => $this->config->db['database'],
            'username'  => $this->config->db['username'],
            'password'  => $this->config->db['password'],
            'charset'   => $this->config->db['charset'],
            'collation' => $this->config->db['collation'],
            'prefix'    => $this->config->db['prefix']
        ]);

        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
}

//CREATE TABLE `mvc`.`users` ( `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT , `login` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `password` VARCHAR(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `name` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , `age` TINYINT UNSIGNED NULL , `about` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL , `ava` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , `ip` INT UNSIGNED NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
//CREATE TABLE `mvc`.`upload` ( `id` SMALLINT UNSIGNED NOT NULL , `img` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , INDEX (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
