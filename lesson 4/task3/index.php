<?php
function number()
{
    for ($i=0; $i<=50; $i++) {
        $arr[] = mt_rand(1, 100);
    }

    return $arr;
}

$data = number();

$file = fopen('number.csv', 'w+');
fputcsv($file, $data);

$file = fopen('number.csv', 'r');
$data = fgetcsv($file);

$sum = 0;
$str = '';
foreach ($data as $number) {
    if ($number % 2 == 0) {
        $str .= $number . '+';
        $sum += $number;
    }
}

$str = substr($str, 0, -1);

echo "Сумма четных чисел ($str) = $sum";
