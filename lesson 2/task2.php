<?php
// Задание #2
/*
1) Функция должна принимать 2 параметра:
        массив чисел;
        строку, обозначающую арифметическое действие,    которое нужно выполнить со всеми элементами массива.
2) Функция должна вывести результат на экран.
3) Функция должна обрабатывать любой ввод, в том числе некорректный и выдавать сообщения об этом
*/

$array = array(
   mt_rand(1, 2),
   mt_rand(1, 2),
   mt_rand(1, 2),
   mt_rand(1, 3)
);
$str = '/';

function math($array, $operand = '+')
{
    if (gettype($operand) !== 'string') {
        echo 'Ошибка: Операнд должен быть сторкой!';
        return false;
    }
    switch ($operand) {
        case '+':
            for ($i = 0; $i < count($array); $i++) {
                if ($i+1 < count($array)) {
                    $str .=  $array[$i] . $operand;
                } else {
                    $str .=  $array[$i];
                }
                $answer += $array[$i];
            }
            break;
        case '-':
            for ($i = 0; $i < count($array); $i++) {
                if ($i+1 < count($array)) {
                    $str .=  $array[$i] . $operand;
                } else {
                    $str .=  $array[$i];
                }
                if ($i == 0) {
                    $answer = $array[$i];
                } else {
                    $answer -= $array[$i];
                }
            }
            break;
        case '*':
            for ($i = 0; $i < count($array); $i++) {
                if ($i+1 < count($array)) {
                    $str .=  $array[$i] . $operand;
                } else {
                    $str .=  $array[$i];
                }
                if ($i == 0) {
                    $answer = $array[$i];
                } else {
                    $answer *= $array[$i];
                }
            }
            break;
        case '/':
            for ($i = 0; $i < count($array); $i++) {
                if ($i+1 < count($array)) {
                    $str .=  $array[$i] . $operand;
                } else {
                    $str .=  $array[$i];
                }
                if ($i == 0) {
                    $answer = $array[$i];
                } else {
                    $answer /= $array[$i];
                }
            }
            break;
        default:
            echo 'Ошибка: Неверный операнд!';
            return false;
    }
    echo $str . '=' . $answer;
}

math($array, $str);
