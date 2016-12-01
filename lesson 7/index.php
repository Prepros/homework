<?php
use Illuminate\Database\Capsule\Manager as Capsule;

require_once $_SERVER['DOCUMENT_ROOT'] . '/mvc/vendor/autoload.php';

require_once 'config.php';
require_once 'Product.php';
require_once 'Category.php';

$faker = \Faker\Factory::create('ru_RU');

//***********
// Миграция
//***********

// Удаление
// Если таблицы существую в БД, то удалить
if (Capsule::schema()->hasTable('products')) {
    Capsule::schema()->drop('products');
}
if (Capsule::schema()->hasTable('categories')) {
    Capsule::schema()->drop('categories');
}

// Создание новые таблицы
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
        $table->text('about');
        $table->double('price', 5, 2);
        $table->integer('category_id')->unsigned();
        $table->foreign('category_id')->references('id')->on('categories');
    });
} catch (Exception $e) {
    echo $e->getMessage();
}

// Входные данные
$categories = array(
    'Lenovo',
    'HTC',
    'Samsung'
);

$products = array(
    'Lenovo' => array(
        'Lenovo A2010',
        'Lenovo Vibe B',
        'Lenovo A916',
        'Lenovo Vibe K5'
    ),
    'HTC' => array(
        'HTC Desire 526G Dual Sim',
        'HTC Desire 820G+',
        'HTC Desire 628 Dual Sim'
    ),
    'Samsung' => array(
        'Samsung Galaxy J5 SM-J500H/DS',
        'Samsung Galaxy A5 SM-A500F'
    )
);

// Заполняем таблицу категорий входными данными
foreach ($categories as $cat) {
    $category = new Category();
    $category->name = $cat;
    $category->save();
}

// Заполняем таблицу продуктов входными данными
foreach ($products as $cat => $index) {
    foreach ($index as $prod) {
        $catobj = Capsule::table('categories')->select('id')->where('name', $cat)->first();
        $product = new Product();
        $product->name = $prod;
        $product->about = $faker->text();
        $product->price = $faker->randomFloat(null, 5, 1000);
        $product->category_id = $catobj->id;
        $product->save();
    }
}

echo "Таблицы созданы и заполнены";