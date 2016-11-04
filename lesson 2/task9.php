<?php
// Задание #9
/*
1) Создайте средствами ОС файл test.txt и поместите
в него текст “Hello, world”
2) Напишите функцию, которая будет принимать имя файла,
открывать файл и выводить содержимое на экран.
*/

function file_open($name, $expansion = '.txt') {
    $file = $name . $expansion;
    if (file_exists($file)) {
        $handler = fopen($file, r);
        echo fread($handler, filesize($file));
        fclose($handler);
    }
}

file_open('test');

