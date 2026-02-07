<?php

/**
 * Лекция 10: Цикл FOREACH в PHP
 */

// Обычный массив
$fruits = ["apple", "banana", "orange"];
echo "Фрукты:\n";
foreach ($fruits as $fruit) {
    echo "  - $fruit\n";
}

// С индексами
echo "\nС индексами:\n";
foreach ($fruits as $index => $fruit) {
    echo "[$index] $fruit\n";
}

// Ассоциативный массив
$user = [
    "name" => "John",
    "age" => 30,
    "city" => "New York"
];
echo "\nПользователь:\n";
foreach ($user as $key => $value) {
    echo "$key: $value\n";
}

// Изменение по ссылке
$numbers = [1, 2, 3, 4, 5];
foreach ($numbers as &$number) {
    $number *= 2;
}
unset($number); // Важно: убрать ссылку после цикла
echo "\nУдвоенные числа: " . implode(', ', $numbers) . "\n";
