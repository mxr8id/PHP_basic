<?php

/**
 * Лекция 1: Область видимости переменных
 */

$globalVar = "Я глобальная переменная";

function demonstrateScope(): void
{
    $localVar = "Я локальная переменная";
    echo $localVar . "\n";

    // Глобальная переменная не видна без global
    // echo $globalVar; // Undefined variable

    global $globalVar;
    echo "В функции: $globalVar\n";
}

function demonstrateStatic(): void
{
    static $counter = 0;
    $counter++;
    echo "Вызов номер: $counter\n";
}

demonstrateScope();
demonstrateStatic(); // 1
demonstrateStatic(); // 2
demonstrateStatic(); // 3
