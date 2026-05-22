<!-- ## Вариант 8
Переменная `$role`: 'admin', 'user', 'guest'. Выведите уровень доступа: 3, 2, 1 соответственно. Используйте if-elseif-else. -->

<?php
$role = 'admin'; 

if ($role === 'admin') {
    $level = 3;
} elseif ($role === 'user') {
    $level = 2;
} elseif ($role === 'guest') {
    $level = 1;
} else {
    $level = 0; 
}

echo "Уровень доступа для роли '$role': $level";
?>