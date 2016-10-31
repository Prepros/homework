<?php
// Задание #6
// Не соответствует заданию (см. пример)
// Исправил
/*
1) Создайте массив $bmw с ячейками:
    model
    speed
    doors
    year
2) Заполните ячейки значениями соответсвенно: “X5”, 120, 5, “2015”
3) Создайте   массивы   $toyota   и   $opel   аналогичные   массиву   $bmw   (заполните  данными)
4) Объедините три массива в один многомерный массив
5) Выведите значения всех трех массивов в виде:
    CAR name
    name ­ model ­speed ­ doors ­ year
Например:
    CAR bmw
    X5 ­120 ­ 5 ­ 2015
*/

$bmw = array(
    'model' => 'X5',
    'speed' => 120,
    'doors' => 5,
    'year' => 2015
);

$toyota = array(
    'model' => 'Camry',
    'speed' => 249,
    'doors' => 4,
    'year' => 2016
);

$opel = array(
    'model' => 'INSIGNIA',
    'speed' => 185,
    'doors' => 4,
    'year' => 2015
);

$auto = array(
   'bmw' => $bmw,
    'toyota' => $toyota,
    'opel' => $opel
);

foreach ($auto as $key => $val) {
    echo 'CAR ' . $key . "<br>";
    echo $val['model'] . ' ' . $val['speed'] . ' ' . $val['doors'] . ' ' . $val['year'] . "<br><hr>";
}
