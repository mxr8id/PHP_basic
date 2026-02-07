<?php

/**
 * Лекция 13: Сортировка массивов в PHP
 */

$numbers = [3, 1, 4, 1, 5, 9, 2, 6];

// Сортировка по значению
sort($numbers);
echo "sort: " . implode(', ', $numbers) . "\n";

rsort($numbers);
echo "rsort: " . implode(', ', $numbers) . "\n";

// Ассоциативные массивы
$ages = ["John" => 30, "Jane" => 25, "Bob" => 35];
asort($ages);
echo "asort (по значению): ";
print_r($ages);

ksort($ages);
echo "ksort (по ключу): ";
print_r($ages);

// Пользовательская функция
$users = [
    ["name" => "John", "age" => 30],
    ["name" => "Jane", "age" => 25],
    ["name" => "Bob", "age" => 35]
];

usort($users, fn($a, $b) => $a['age'] <=> $b['age']);
echo "usort по age:\n";
print_r($users);

// Навигация по массиву
reset($numbers);
echo "reset/current: " . current($numbers) . "\n";
echo "next: " . next($numbers) . "\n";
echo "end: " . end($numbers) . "\n";
