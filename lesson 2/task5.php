<?php
// Задание #5
/*
Написать две функции.
Функция №1 принимает 1 строковый параметр и возвращает true,
если строка является палиндромом*, false в противном случае.
Пробелы и регистр не должны учитываться.
Функция №2 выводит сообщение в котором на русском языке оговаривается
результат из функции №1
* Палиндром – строка, одинаково читающаяся в обоих направлениях.
*/

function palimdor($str)
{
    // Убираем пробелы
    $str = str_replace(' ', '', $str);
    // Переводим все буквы в нижний регистр
    $str = mb_strtolower($str);
    // Считаем количество букв
    $strlen = mb_strlen($str);

    // Если количество букв нечетно, то проверяем на палимдор
    if ($strlen % 2 !== 0) {
        // Находим центральную букву
        $center_char = floor($strlen / 2);
        // Находим все буквы слева, до центральной
        $left_chars = mb_substr($str, 0, $center_char);
        // Находим все буквы справа, до центральной
        $right_chars = mb_substr($str, $center_char + 1);
        // Переводим правые буквы в кодировку windows-1251
        $right_chars = iconv('utf-8', 'windows-1251', $right_chars);
        // Переворачиваем символы наоборот
        $right_chars = strrev($right_chars);
        // Возвращаем кодировку utf-8
        $right_chars = iconv('windows-1251', 'utf-8', $right_chars);

        // Сверяем правую и левую часть слова
        if ($left_chars === $right_chars) {
            // Если равны, то палимдор
            return true;
        } else {
            // Если не равны, то помидор
            return false;
        }
    } else {
        return false; // Количество букв четно, не палимдор
    }
}

// Функция вывода сообщения о наличии палимдора
function palimdor_message($answer)
{
    if ($answer) {
        echo 'Палимдор';
    } else {
        echo 'Не палимдор';
    }
}

// Вызов функций
$answer = palimdor('пролДлорп');
palimdor_message($answer);
