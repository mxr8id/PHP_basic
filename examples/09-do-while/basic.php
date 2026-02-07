<?php

/**
 * Лекция 9: Цикл DO...WHILE в PHP
 */

// Базовый do-while
echo "Базовый do-while:\n";
$count = 0;
do {
    echo "Count: $count\n";
    $count++;
} while ($count < 5);

// Гарантированное выполнение хотя бы один раз
echo "\nПопытки подключения (симуляция):\n";
$attempts = 0;
do {
    $attempts++;
    $success = ($attempts >= 2); // Симуляция: успех со 2-й попытки
    echo "Попытка $attempts - " . ($success ? "Успех!" : "Ошибка") . "\n";
} while (!$success && $attempts < 3);

// Валидация ввода (CLI) - закомментировано для Web-совместимости
// do {
//     $age = (int)readline("Введите возраст (18-100): ");
// } while ($age < 18 || $age > 100);
// echo "Возраст принят: $age";
