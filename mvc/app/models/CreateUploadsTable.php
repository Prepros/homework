<?php
namespace app\models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CreateUploadsTable extends Eloquent
{
    // Выполнение миграций.

    //CREATE TABLE `mvc`.`upload` (
    // `id` SMALLINT UNSIGNED NOT NULL ,
    // `img` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , INDEX (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;


    public function up()
    {
        try {
            Capsule::schema()->create('uploads', function ($table) {
                $table->smallInteger('id');
                $table->string('img', 255);
            });
            $_SESSION['message'] = 'Таблица успешно uploads создана';
        } catch (ModelNotFoundException $e) {
            $_SESSION['message'] = 'Ошибка создания таблицы uploads ' . $e->getMessage();
        }
    }

    // Отмена миграций.
    public function down()
    {
        try {
            Capsule::schema()->drop('uploads');
            $_SESSION['message'] = 'Таблица успешно uploads удалена';
        } catch (ModelNotFoundException $e) {
            $_SESSION['message'] = 'Ошибка удаления таблицы uploads ' . $e->getMessage();
        }
    }
}
