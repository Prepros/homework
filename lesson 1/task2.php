<?php
// Задание #2
// Принято
/*
1) Дана задача:
На школьной выставке 80 рисунков.
23 из них выполнены фломастерами, 40 карандашами, а остальные — красками.
Сколько рисунков, выполненные красками, на школьной выставке?
2) Описать условия и решение этой задачи на PHP. Все числа должны быть указаны из переменных.
*/

$risunkov = 80;
$flomaster = 23;
$karandash = 40;
$kraski = $risunkov - ($flomaster + $karandash);
echo "На школьной выставке $risunkov рисунков. 
            $flomaster из них выполнены фломастерами, 
            $karandash карандашами, а остальные — красками. <br>";
echo "Сколько рисунков, выполненные красками, на школьной выставке? <br>";
echo "Красками выполнено $kraski рисунков.";
