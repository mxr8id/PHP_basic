<!-- ## Вариант 8
Объедините три массива в один: [1, 2], [3], [4, 5, 6]. Используйте array_merge. Выведите длину и сумму элементов (array_sum). -->

<?php
$arr1 = [1, 2];
$arr2 = [3];
$arr3 = [4, 5, 6];
$merged = array_merge($arr1, $arr2, $arr3);
echo "Объединённый массив: ";
print_r($merged);
echo "Длина: " . count($merged) . "\n";
echo "Сумма элементов: " . array_sum($merged) . "\n";
?>