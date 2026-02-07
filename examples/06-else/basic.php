<?php

/**
 * Лекция 6: Оператор ELSE в PHP
 * if-else, switch, match
 */

$score = 85;

// if-else
if ($score >= 90) {
    echo "Оценка: Отлично\n";
} elseif ($score >= 70) {
    echo "Оценка: Хорошо\n";
} else {
    echo "Оценка: Удовлетворительно\n";
}

// switch-case
$day = "Monday";
switch ($day) {
    case "Monday":
        echo "День: Понедельник\n";
        break;
    case "Tuesday":
        echo "День: Вторник\n";
        break;
    default:
        echo "День: Другой день\n";
}

// Match expression (PHP 8.0+)
$result = match ($score) {
    100 => "Perfect",
    90, 95 => "Excellent",
    80, 85 => "Good",
    default => "Average"
};
echo "Match результат: $result\n";
