<!-- ## Вариант 8
Напишите выражение с null coalescing: `$name = $user['name'] ?? $config['default_name'] ?? 'Гость'`. Симулируйте $user и $config, выведите итоговое имя в трёх сценариях. -->

<?php
// Сценарий 1: имя есть в $user
$user = ['name' => 'Анна'];
$config = ['default_name' => 'Пользователь'];
$name = $user['name'] ?? $config['default_name'] ?? 'Гость';
echo "Сценарий 1: $name\n"; 

// Сценарий 2: имени в $user нет, но есть в $config
$user = [];
$config = ['default_name' => 'Пользователь'];
$name = $user['name'] ?? $config['default_name'] ?? 'Гость';
echo "Сценарий 2: $name\n"; 

// Сценарий 3: нет ни в $user, ни в $config
$user = [];
$config = [];
$name = $user['name'] ?? $config['default_name'] ?? 'Гость';
echo "Сценарий 3: $name\n"; 
?>