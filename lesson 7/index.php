<?php
use Illuminate\Database\Capsule\Manager as Capsule;

require_once $_SERVER['DOCUMENT_ROOT'] . '/mvc/vendor/autoload.php';

require_once 'config.php';
require_once 'Product.php';
require_once 'Category.php';

$product = new Product();
$category = new Category();


//***********
// Миграция
//***********

// Удаление
//Capsule::schema()->drop('products');
//Capsule::schema()->drop('categories');
//exit;

// Создание
try {
    Capsule::schema()->create('categories', function ($table) {
        $table->increments('id');
        $table->string('name');
    });
} catch (Exception $e) {
    echo $e->getMessage();
}

try {
    Capsule::schema()->create('products', function ($table) {
        $table->increments('id');
        $table->string('name');
        $table->integer('category_id')->unsigned();
        $table->foreign('category_id')->references('id')->on('categories');
    });
} catch (Exception $e) {
    echo $e->getMessage();
}
