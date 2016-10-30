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
    $num_args = func_num_args();
    $args = func_get_args();
    switch ($operand) {
        case '+':
            $answer = 0;
            foreach ($args as $key => $val) {
                if ($key == 0) {
                    continue;
                }
                if ($key + 1 ==  $num_args) {
                    $str .= $val;
                } else {
                    $str .= $val . $operand;
                }
                $answer += $val;
            }
            break;
        case '-':
            foreach ($args as $key => $val) {
                if ($key == 0) {
                    continue;
                }
                if ($key + 1 ==  $num_args) {
                    $str .= $val;
                } else {
                    $str .= $val . $operand;
                }
                if ($key == 1) {
                    $answer = $val;
                    continue;
                }
                $answer -= $val;
            }
            break;
        case '*':
            foreach ($args as $key => $val) {
                if ($key == 0) {
                    continue;
                }
                if ($key + 1 ==  $num_args) {
                    $str .= $val;
                } else {
                    $str .= $val . $operand;
                }
                if ($key == 1) {
                    $answer = $val;
                    continue;
                }
                $answer *= $val;
            }
            break;
        case '/':
            foreach ($args as $key => $val) {
                if ($key == 0) {
                    continue;
                }
                if ($key + 1 ==  $num_args) {
                    $str .= $val;
                } else {
                    $str .= $val . $operand;
                }
                if ($key == 1) {
                    $answer = $val;
                    continue;
                }
                $answer /= $val;
            }
            break;
    }
    $answer = $str . '=' . $answer;
    echo $answer;
}

calcEverything('/', 1, 2, 3, 4, 1.5);
