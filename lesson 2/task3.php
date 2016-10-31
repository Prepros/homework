<?php
// Задание #3
/*
1) Функция должна принимать переменное число аргументов.
2) Первым аргументом обязательно должна быть строка, обозначающая
арифметическое действие, которое необходимо выполнить со всеми передаваемыми аргументами.
3) Остальные аргументы это целые и/или вещественные числа.
Пример вызова: calcEverything(‘+’, 1, 2, 3, 5.2);
Результат: 1 + 2 + 3 + 5.2 = 11.2
*/

function calcEverything($operand, $a, $b, $c, $d, $e)
{
    $args = func_get_args();
    $operand = array_shift($args);
    $str = implode($operand, $args);

    switch ($operand) {
        case '+':
            foreach ($args as $val) {
                $answer += $val;
            }
            break;
        case '-':
            foreach ($args as $key => $val) {
                if ($key === 0) {
                    $answer = $val;
                    continue;
                }
                $answer -= $val;
            }
            break;
        case '*':
            $answer = 1;
            foreach ($args as $val) {
                $answer *= $val;
            }
            break;
        case '/':
            foreach ($args as $key => $val) {
                if ($key === 0) {
                    $answer = $val;
                    continue;
                }
                $answer /= $val;
            }
            break;
    }
    echo $str . '=' . $answer;
}

calcEverything("/", 1, 2, 3, 4, 1.5);
