<?php
// Задание #3
// Условие задачи выполнено, но скрипт вызывает 500 ошибку.
// Исправить.
// Исправил
/*
1) Создайте константу и присвойте ей значение.
2) Проверьте, существует ли константа, которую Вы хотите использовать
3) Выведите значение созданной константы
4) Попытайтесь изменить значение созданной константы.
*/

define('MY', "Моя константа");

if (defined('MY')) {
    echo MY;
} else {
    echo "Константа не существует.";
}

define('MY', "Не моя константа");
