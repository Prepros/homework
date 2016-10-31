<?php
// Задание #4
/*
1) Функция должна принимать два параметра – целые числа.
2) Если в функцию передали 2 целых числа, то функция должна отобразить
 таблицу умножения размером со значения параметров, переданных в функцию.
(Например если передано 8 и 8, то нарисовать от 1х1 до 8х8)
3) В остальных случаях выдавать корректную ошибку.
*/

function multiTable($a, $b)
{
    if (gettype($a) !== 'integer' && gettype($b) !== 'integer') {
        echo "Ошибка: Передаваемые параметры должны быть целыми числами!";
        return false;
    }

    echo "<table width='100%' cellpadding='20' cellspacing='0' border='1'>";
    echo "<tr>";

    for ($i = 1; $i <= 10 ; $i++) {
        echo "<td>";
        for ($j = 1; $j <= 10; $j++) {
            echo "<table>";
            echo "<tr>";
            echo "<td>";
            if ($i == $a && $j == $b + 1) {
                return true;
            }
            echo "$i * $j = " . $i * $j;
            echo "<br>";
            echo "</td>";
            echo "</tr>";
            echo "</table>";
        }
        echo "</td>";
    }

    echo "</tr>";
    echo "</table>";
}

multiTable(8, 8);
