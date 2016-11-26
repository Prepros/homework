<?php
namespace app\models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUsersTable extends Eloquent
{
    // Выполнение миграций.

    //CREATE TABLE `mvc`.`users` (
    // `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
    // `login` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    // `password` VARCHAR(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    // `name` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    // `age` TINYINT UNSIGNED NULL ,
    // `about` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    // `ava` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    // `ip` INT UNSIGNED NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

    public function up()
    {
        try {
            Capsule::schema()->create('users', function ($table) {
                $table->increments('id');
                $table->string('login', 15);
                $table->string('password', 18);
                $table->string('name', 30);
                $table->tinyInteger('age')->unsigned();
                $table->text('about');
                $table->string('ava', 255);
                $table->integer('ip');
            });
            $_SESSION['message'] = 'Таблица users успешно создана';
        } catch (ModelNotFoundException $e) {
            $_SESSION['message'] = 'Ошибка создания таблицы users ' . $e->getMessage();
        }
    }

    // Отмена миграций.
    public function down()
    {
        try {
            Capsule::schema()->drop('users');
            $_SESSION['message'] = 'Таблица users успешно удалена';
        } catch (ModelNotFoundException $e) {
            $_SESSION['message'] = 'Ошибка удаления таблицы users ' . $e->getMessage();
        }
    }
}
