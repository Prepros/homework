<?php
function random6() {
    return mt_rand(1,9) . mt_rand(1,9) . mt_rand(1,9) . mt_rand(1,9) . mt_rand(1,9) . mt_rand(1,9);
}

$phone_book = array(
    'teacher' => array(
        'Irina Petrovna' => 235261,
        'Lena Larina' => 232361,
        'Vyacheslav Gavrilov' => 120526
    ),
    'students' => array(
        'Mihail Tapkin' => 627262,
        'Zhenya Mishkin' => 125689,
        'Anna Mironova' => 345896,
    )
);

$json_encode = json_encode($phone_book);
file_put_contents('output.json', $json_encode);

$output = file_get_contents('output.json');
$output_arr = json_decode($output, true);

if (mt_rand(1,2) == 1) {
    $i = 1;
    foreach ($output_arr['teacher'] as $name => $phone) {
        $random = mt_rand(1, count($output_arr['teacher']));
        if ($i == $random) {
            $phone_book['teacher'][$name] = random6();
        }
        $i++;
    }
}
if (mt_rand(1,2) == 2) {
    $i = 1;
    foreach ($output_arr['students'] as $name => $phone) {
        $random = mt_rand(1, count($output_arr['students']));
        if ($i == $random) {
            $phone_book['students'][$name] = random6();
        }
        $i++;
    }
}

$json_encode = json_encode($phone_book);
file_put_contents('output2.json', $json_encode);

$output2 = file_get_contents('output2.json');
$output_arr2 = json_decode($output2, true);


if (count($output_arr) == count($output_arr2)) {
    $teacher = array_diff($output_arr2['teacher'], $output_arr['teacher']);
    $students = array_diff($output_arr2['students'], $output_arr['students']);
}

if (!empty($teacher)) {
    echo "В файле output2.json были найдены следующие изменения номеров преподавателей: <br>";
    foreach ($teacher as $persona => $number) {
        echo "$persona поменял(а) свой номер на $number <br>";
    }
} else {
    echo "Изменений в телефонном справочнике преподавателей не обнаружено! <br>";
}

echo "<br><hr><br>";

if (!empty($students)) {
    echo "В файле output2.json были найдены следующие изменения номеров студентов: <br>";
    foreach ($students as $persona => $number) {
        echo "$persona поменял(а) свой номер на $number <br>";
    }
} else {
    echo "Изменений в телефонном справочнике студентов не обнаружено! <br>";
}
