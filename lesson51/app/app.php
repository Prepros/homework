<?php
namespace app\core;

require_once 'core/config.php';
require_once 'core/functions.php';
require_once 'core/route.php';
require_once 'core/controller.php';
require_once 'core/model.php';


// Запускаем логику обработки запроса
Route::getInstance();
