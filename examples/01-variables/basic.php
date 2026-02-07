<?php

/**
 * Лекция 1: Переменные в PHP
 * Базовое объявление переменных и констант
 */

// Базовое объявление переменных
$age = 25;
$name = "John";
$isStudent = true;

echo "Имя: $name, Возраст: $age, Студент: " . ($isStudent ? 'да' : 'нет') . "\n";

// Константы
const PI = 3.14159;
define('MAX_USERS', 100);

echo "PI = " . PI . ", MAX_USERS = " . MAX_USERS . "\n";

// Переменные переменных
$variableName = 'name';
echo "Переменная переменных ($$variableName): " . $$variableName . "\n";

// Типизированные свойства класса (PHP 7.4+)
class User
{
    public int $typedAge = 30;
    public string $typedName = "Jane";
}

$user = new User();
echo "Типизированные свойства: {$user->typedName}, {$user->typedAge}\n";
