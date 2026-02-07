<?php

/**
 * Лекция 11: Функции для обработки строк в PHP
 */

$text = "Hello World";

// Базовые функции
echo "strlen: " . strlen($text) . "\n";
echo "strtoupper: " . strtoupper($text) . "\n";
echo "strtolower: " . strtolower($text) . "\n";
echo "ucfirst: " . ucfirst($text) . "\n";

// Поиск и замена
echo "strpos('World'): " . strpos($text, "World") . "\n";
echo "str_replace: " . str_replace("World", "PHP", $text) . "\n";
echo "substr(0, 5): " . substr($text, 0, 5) . "\n";

// Разделение и объединение
$words = explode(" ", $text);
print_r($words);
echo "implode: " . implode("-", $words) . "\n";

// Удаление пробелов
$trimmed = trim("  Hello  ");
echo "trim: '$trimmed'\n";

// Форматирование
echo sprintf("Name: %s, Age: %d\n", "John", 30);
