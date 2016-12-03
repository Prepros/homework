<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/mvc/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'lesson7',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

class Category extends Illuminate\Database\Eloquent\Model
{
    public $table = 'categories';
    public $timestamps = false;

    public function categories()
    {
        return $this->hasMany('Product', 'category_id', 'id');
    }
}
class Product extends Illuminate\Database\Eloquent\Model
{
    public $table = 'products';
    public $timestamps = false;

    public function products()
    {
        return $this->belongsTo('Category', 'category_id', 'id');
    }
}
