<?php

/**
 * Лекция 2: Типы данных PHP
 * Скалярные и составные типы
 */

// Скалярные типы
$integer = 42;
$floating = 3.14;
$string = "Hello World";
$boolean = true;

echo "Integer: $integer, Float: $floating, String: $string, Bool: $boolean\n";

// Составные типы
$array = [1, 2, 3];
$object = new stdClass();
$object->name = "Test";
$object->field = "Test Field";
var_dump($object);
// Типизация в функциях
function add(int $a, int $b): int
{
    return $a + $b;
}

echo "add(5, 3) = " . add(5, 3) . "\n";

// Union types (PHP 8.0+)
function processValue(int|string $value): void
{
    echo "Обработано: $value\n";
}

processValue(42);
processValue("text");
