<?php
// Задание #2
/*
1) Функция должна принимать 2 параметра:
        массив чисел;
        строку, обозначающую арифметическое действие, которое нужно выполнить со всеми элементами массива.
2) Функция должна вывести результат на экран.
3) Функция должна обрабатывать любой ввод, в том числе некорректный и выдавать сообщения об этом
*/

function math($array, $operand = '+')
{

    if (gettype($operand) !== 'string') {
        echo 'Ошибка: Операнд должен быть сторкой!';
        return false;
    }
    switch ($operand) {
        case '+':
            $str = implode('+', $array);
            foreach ($array as $val) {
                $answer += $val;
            }
            break;
        case '-':
            $str = implode('-', $array);
            foreach ($array as $key => $val) {
                if ($key === 0) {
                    $answer = $val;
                    continue;
                }
                $answer -= $val;
            }
            break;
        case '*':
            $str = implode('*', $array);
            $answer = 1;
            foreach ($array as $key => $val) {
                $answer *= $val;
            }
            break;
        case '/':
            $str = implode('/', $array);
            foreach ($array as $key => $val) {
                if ($key === 0) {
                    $answer = $val;
                    continue;
                }
                $answer /= $val;
            }
            break;
        default:
            echo 'Ошибка: Неверный операнд!';
            return false;
    }
    echo $str . '=' . $answer;
}

$array = array(
    mt_rand(1, 2),
    mt_rand(1, 2),
    mt_rand(1, 2),
    mt_rand(1, 3)
);

math($array, '/');
