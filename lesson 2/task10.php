<?php
// Задание #9
/*
1) Создайте файл anothertest.txt средствами PHP.
Поместите в него текст - “Hello again!”
*/

$handler = fopen('anothertest.txt', 'a+');
if (fwrite($handler, 'Hello again!')) {
    echo "Файл успешно создан, текст добавлен";
} else {
    "Ошибка создания файла";
}
fclose($handler);
