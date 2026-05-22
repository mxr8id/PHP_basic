<!-- ## Вариант 8
Напишите функцию `inRange(int $value, int $min, int $max): bool`, возвращающую true, если value между min и max включительно. Используйте только операторы сравнения. -->

<?php
function inRange(int $value, int $min, int $max): bool {
    return $value >= $min && $value <= $max;
}

echo inRange(5, 1, 10) ? ' true' : ' false'; 
echo inRange(0, 1, 10) ? ' true' : ' false'; 
?>