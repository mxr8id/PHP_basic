<?php

/**
 * Лекция 19: Взаимодействие PHP и MySQL (продолжение)
 * Получение данных и пагинация
 *
 * Запуск: убедитесь, что база данных существует
 */

// Подключение к базе данных
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=testdb;charset=utf8mb4',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
}

// Создание тестовой таблицы (если не существует)
try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            age INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    // Вставка тестовых данных (только если таблица пустая)
    $count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    if ($count == 0) {
        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, age) VALUES 
            ('John Doe', 'john@example.com', 25),
            ('Jane Smith', 'jane@example.com', 30),
            ('Bob Johnson', 'bob@example.com', 35),
            ('Alice Brown', 'alice@example.com', 28),
            ('Charlie Davis', 'charlie@example.com', 32)
        ");
        $stmt->execute();
        echo "Тестовые данные добавлены\n\n";
    }
} catch (PDOException $e) {
    die("Ошибка при работе с таблицей: " . $e->getMessage());
}

// Пример 1: Получение всех строк
echo "=== Пример 1: Все пользователи ===\n";
$stmt = $pdo->query("SELECT id, name, email, age FROM users ORDER BY id");
$users = $stmt->fetchAll();

foreach ($users as $user) {
    echo "ID: {$user['id']}, Name: {$user['name']}, Email: {$user['email']}, Age: {$user['age']}\n";
}
echo "\n";

// Пример 2: Получение одной строки по id
echo "=== Пример 2: Пользователь с ID=1 ===\n";
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([1]);
$user = $stmt->fetch();

if ($user) {
    echo "Найден пользователь:\n";
    print_r($user);
} else {
    echo "Пользователь не найден\n";
}
echo "\n";

// Пример 3: Пагинация
echo "=== Пример 3: Пагинация ===\n";
$page = (int)max(1, $_GET['page'] ?? 1);
$perPage = 2;
$offset = ($page - 1) * $perPage;

echo "Запрос: Страница $page, Показать $perPage записей, Смещение $offset\n\n";

$stmt = $pdo->prepare("
    SELECT * FROM users 
    ORDER BY id 
    LIMIT :limit OFFSET :offset
");
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$paginatedUsers = $stmt->fetchAll();

echo "Результаты:\n";
foreach ($paginatedUsers as $user) {
    echo "  - {$user['name']} ({$user['email']})\n";
}

// Общее количество записей
$total = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalPages = ceil($total / $perPage);

echo "\nВсего записей: $total, Страниц: $totalPages\n";
echo "Текущая страница: $page\n";

// Навигация
if ($page > 1) {
    echo "← Предыдущая страница: " . ($page - 1) . "\n";
}
if ($page < $totalPages) {
    echo "→ Следующая страница: " . ($page + 1) . "\n";
}
?>