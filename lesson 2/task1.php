<?php
// Задание #1
/*
1) Функция должна принимать массив строк и выводить каждую строку
в отдельном параграфе (тег <p>)
2) Если в функцию передан второй параметр true, то возвращать (через return)
результат в виде одной объединенной строки.
*/

$array = array(
    'Строка 1',
    'Строка 2',
    'Строка 3',
    'Строка 4',
    'Строка 5',
);

function array_str($array, $bol = false)
{
    if ($bol) {
        return  implode (" ", $array);
    }
    for ($i = 0; $i < count($array); $i++) {
        echo "<p>$array[$i]</p>";
    }
}

echo "<h2>Версия без true</h2>";
array_str($array);
echo "<br>";

echo "<h2>Версия с true</h2>";
echo array_str($array, true);
