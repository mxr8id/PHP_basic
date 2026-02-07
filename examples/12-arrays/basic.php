<?php

/**
 * Лекция 12: Создание массивов в PHP
 */

// Создание массивов
$numbers = [1, 2, 3, 4, 5];
$fruits = array("apple", "banana", "orange");

// Ассоциативные массивы
$user = [
    "name" => "John",
    "age" => 30,
    "city" => "New York"
];

// Добавление элементов
$numbers[] = 6;
array_push($numbers, 7, 8); // Возвращает int (количество), не массив!

// Удаление элементов
unset($fruits[1]);
$last = array_pop($numbers);
$first = array_shift($numbers);

echo "Numbers после операций: " . implode(', ', $numbers) . "\n";
echo "Fruits: " . implode(', ', $fruits) . "\n";

// Полезные функции
echo "count(numbers): " . count($numbers) . "\n";
echo "in_array('apple', fruits): " . (in_array("apple", $fruits) ? 'true' : 'false') . "\n";
echo "array_keys(user): " . implode(', ', array_keys($user)) . "\n";
echo "array_values(user): " . implode(', ', array_values($user)) . "\n";
