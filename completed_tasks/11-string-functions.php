<!-- ## Вариант 8
Переведите строку в верхний регистр (strtoupper) и в нижний (strtolower). Для строки «Hello World» выведите оба варианта. -->

<?php
$str = "Hello World";
echo "Исходная: $str\n";
echo "Верхний регистр: " . strtoupper($str) . "\n";
echo "Нижний регистр: " . strtolower($str) . "\n";
?>