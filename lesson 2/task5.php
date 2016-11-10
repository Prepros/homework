<?php
// Задание #5
// Не принято
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

    // А если четно? Разве строка "ААББВВ" не является палиндромом?
    // Исправил, теперь так же находится палиндромом с четныйм количеством символов

    // Находим центральную букву
    $center_char = floor($strlen / 2);
    // Находим все буквы слева, до центральной
    $left_chars = mb_substr($str, 0, $center_char);

    if ($strlen % 2 !== 0) {
        // Находим все буквы справа, до центральной
        $right_chars = mb_substr($str, $center_char + 1);
    } else {
        // Находим все буквы справа
        $right_chars = mb_substr($str, $center_char);
    }

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
}

// Функция вывода сообщения о наличии палимдора
function palimdor_message($str)
{
    if (palimdor($str)) {
        echo 'Палимдор';
    } else {
        echo 'Не палимдор';
    }
}

// Вызов функций
echo $str = 'АББА';
echo "\n";
palimdor_message($str);
echo "\n";
