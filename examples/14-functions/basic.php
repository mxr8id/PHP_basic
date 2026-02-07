<?php

/**
 * Лекция 14: Функции в PHP
 */

// Базовая функция
function greet(string $name): string
{
    return "Hello, $name!";
}
echo greet("John") . "\n";

// Функция с типизацией
function add(int $a, int $b): int
{
    return $a + $b;
}

// Параметры по умолчанию
function createEmail(string $name, string $domain = "example.com"): string
{
    return strtolower($name) . "@$domain";
}
echo createEmail("John") . "\n";
echo createEmail("Jane", "test.org") . "\n";

// Анонимные функции
$double = function ($x) {
    return $x * 2;
};
echo "double(5) = " . $double(5) . "\n";

// Arrow functions (PHP 7.4+)
$add = fn($a, $b) => $a + $b;
echo "add(3, 4) = " . $add(3, 4) . "\n";

// Переменное количество аргументов
function sum(...$numbers): int|float
{
    return array_sum($numbers);
}
echo "sum(1,2,3,4,5) = " . sum(1, 2, 3, 4, 5) . "\n";
