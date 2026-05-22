<!-- ## Вариант 8
Переменное количество аргументов: функция `product(...$numbers)` возвращает произведение всех переданных чисел. product(2, 3, 4) → 24. Выведите. -->

<?php
function product(...$numbers): int|float {
    $result = 1;
    foreach ($numbers as $num) {
        $result *= $num;
    }
    return $result;
}

echo "product(2, 3, 4) = " . product(2, 3, 4) . "\n";
echo "product(1, 5, 2, 3) = " . product(1, 5, 2, 3) . "\n";
echo "product(7) = " . product(7) . "\n";
?>