<?php

/**
 * Лекция 20: Сессии в PHP
 *
 * Запуск: через веб-сервер (Apache/nginx) или php -S localhost:8000
 * В CLI сессии работают иначе (нужен явный вызов)
 */

// Настройка безопасности (ДОЛЖНО быть до session_start)
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => '',
    'secure' => false, // true только для HTTPS
    'httponly' => true,
    'samesite' => 'Strict'
]);

// Запуск сессии
session_start();

// Регенерация ID (защита от фиксации сессии)
session_regenerate_id(true);

// Установка данных сессии
$_SESSION['user_id'] = 123;
$_SESSION['username'] = 'john_doe';
$_SESSION['login_time'] = time();

// Получение данных
if (isset($_SESSION['user_id'])) {
    echo "Добро пожаловать, {$_SESSION['username']}!\n";
}

// Проверка авторизации
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Пример вызова проверки
if (isLoggedIn()) {
    echo "Пользователь авторизован\n";
} else {
    echo "Пользователь не авторизован\n";
}

// Пример logout
function logout(): void
{
    // Очистка данных сессии
    $_SESSION = [];

    // Удаление cookie сессии
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }

    // Уничтожение сессии
    session_destroy();

    // Редирект (только в веб-окружении)
    if (php_sapi_name() !== 'cli') {
        header('Location: login.php');
        exit;
    }
}

// Пример использования (раскомментировать для теста)
// logout();
?>