<?php

/**
 * Лекция 8: Циклы WHILE в PHP
 */

// Цикл while
echo "Цикл while:\n";
$count = 0;
while ($count < 5) {
    echo "Count: $count\n";
    $count++;
}

// Бесконечный цикл с break (имитация ввода)
echo "\nСимуляция ввода (break при count=3):\n";
$count = 0;
while (true) {
    $count++;
    echo "Итерация $count\n";
    if ($count >= 3) {
        break;
    }
}

// Несколько условий
echo "\nДва счётчика:\n";
$i = 0;
$j = 10;
while ($i < 5 && $j > 5) {
    echo "i=$i, j=$j\n";
    $i++;
    $j--;
}
