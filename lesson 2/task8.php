<?php
// Задание #8
// Не соответствует заданию
/*
1) Напишите функцию, которая с помощью регулярных выражений,
получит информацию о переданных RX пакетах из переданной строки:
2) Пример строки: “RX packets:950381 errors:0 dropped:0 overruns:0 frame:0. “
3) Если кол-во пакетов более 1000, то выдавать сообщение: “Сеть есть”
4) Если в переданной в функцию строке есть “:)”, то нарисовать смайл в
ASCII и не выдавать сообщение из пункта №3. Смайл должен храниться в отдельной функции
*/

function smile() {
    echo "<div style='font-size: 18px;width: 900px; text-align: center; margin: 150px auto 0;'>"
        . file_get_contents('smile.txt') .
        "</div>";
}

// РЕГУЛЯРНЫЕ ВЫРАЖЕНИЯ
// .* - любое количество разных символов
// packets:(\d+) - находим строку packets:(цыфры от 0-9, от 1 до бесконечности)
// .* - любые другие символы после packets
$reg_packets = '/.* packets:(\d+) .*/i';

// Регулярное выражение смайла
$reg_smile = '/(:\)+?)/i';

// Строка RX пакетов со смайлом
$rx = 'RX packets:950381 errors:10 dropped:0 :) overruns:0 frame:0. ';

// Строка RX пакетов без смайла (больше 1000)
//$rx = 'RX packets:950381 errors:10 dropped:0 overruns:0 frame:0. ';

// Строка RX пакетов без смайла (меньше 1000)
//$rx = 'RX packets:950 errors:10 dropped:0 overruns:0 frame:0. ';

if (preg_match($reg_smile, $rx)) {
    smile();
} elseif (preg_match($reg_packets, $rx)) {
    $packets = preg_replace($reg_packets, '$1', $rx);
    if ($packets > 1000) {
        echo "Сеть есть! Пакетов ($packets)";
    } else {
        echo "Сети нет! Пакетов ($packets)";
    }
}