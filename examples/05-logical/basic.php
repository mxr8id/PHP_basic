<?php

/**
 * Лекция 5: Логические операторы PHP
 */

$a = true;
$b = false;
$c = true;

// Логические операторы
var_dump($a && $b); // false
var_dump($a || $b); // true
var_dump(!$a);      // false
var_dump($a and $b); // false
var_dump($a or $b);  // true

// Приоритет: && имеет больший приоритет, чем ||
var_dump($a || $b && $c); // true (сначала $b && $c = false, потом $a || false = true)

// Короткое замыкание - функция не вызовется, т.к. $b = false
function expensiveFunction(): bool
{
    echo "expensiveFunction вызвана!\n";
    return true;
}

$result = $a && expensiveFunction(); // expensiveFunction вызовется
$result = $b && expensiveFunction(); // expensiveFunction НЕ вызовется (короткое замыкание)
