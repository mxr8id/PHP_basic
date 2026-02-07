<?php

/**
 * Лекция 4: Операторы сравнения PHP
 */

$a = 5;
$b = "5";

// Сравнение значений
var_dump($a == $b);  // true
var_dump($a === $b); // false (разные типы)

// Другие операторы
var_dump($a > 3);   // true
var_dump($a < 10);  // true
var_dump($a >= 5);  // true
var_dump($a <= 5);  // true
var_dump($a != 10); // true
var_dump($a !== "5"); // true

// Spaceship operator (PHP 7.0+)
echo "5 <=> 3 = " . (5 <=> 3) . "\n";  // 1
echo "3 <=> 5 = " . (3 <=> 5) . "\n";  // -1
echo "5 <=> 5 = " . (5 <=> 5) . "\n";  // 0
