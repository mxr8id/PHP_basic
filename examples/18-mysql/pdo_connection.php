<?php

/**
 * Лекция 18: Взаимодействие PHP и MySQL
 * Подключение через PDO и mysqli
 *
 * Для работы настройте переменные окружения или значения ниже.
 * В Laravel Sail используйте: host=mysql, dbname=ваша_база
 */

// Конфигурация (в реальном проекте - из .env)
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_DATABASE') ?: 'testdb';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';

// Создание базы данных (если не существует)
try {
    $pdoCreate = new PDO(
        "mysql:host=$host;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
    $pdoCreate->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdoCreate = null;
} catch (PDOException $e) {
    echo "Ошибка создания БД: " . $e->getMessage() . "\n";
}

// Подключение через PDO
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
    echo "✓ PDO: Подключение успешно!\n";

    // Создание тестовой таблицы
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
            ('Bob Johnson', 'bob@example.com', 35)
        ");
        $stmt->execute();
        echo "✓ Тестовые данные добавлены в PDO\n";
    }

    // Пример подготовленного запроса
    $stmt = $pdo->prepare("SELECT * FROM users WHERE age > ?");
    $stmt->execute([28]);
    $users = $stmt->fetchAll();

    echo "\n=== Результаты PDO (возраст > 28) ===\n";
    foreach ($users as $user) {
        echo "ID: {$user['id']}, Name: {$user['name']}, Age: {$user['age']}\n";
    }

    // Явное закрытие соединения
    $pdo = null;
    echo "\n✓ PDO: Соединение закрыто\n";

} catch (PDOException $e) {
    echo "✗ Ошибка PDO: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n";

// Подключение через mysqli
$mysqli = new mysqli($host, $user, $pass, $dbname);

// Включение исключений для обработки ошибок
$mysqli->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, true);

if ($mysqli->connect_error) {
    echo "✗ Ошибка mysqli: " . $mysqli->connect_error . "\n";
    exit(1);
}

try {
    $mysqli->set_charset("utf8mb4");
    echo "✓ mysqli: Подключение успешно!\n";

    // Пример запроса через mysqli
    $result = $mysqli->query("SELECT * FROM users WHERE age > 28");

    echo "\n=== Результаты mysqli (возраст > 28) ===\n";
    while ($row = $result->fetch_assoc()) {
        echo "ID: {$row['id']}, Name: {$row['name']}, Age: {$row['age']}\n";
    }
    $result->free();

    // Пример подготовленного запроса через mysqli
    $stmt = $mysqli->prepare("SELECT name, email FROM users WHERE id = ?");
    $id = 1;
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "\n=== Подготовленный запрос mysqli (ID=1) ===\n";
    $user = $result->fetch_assoc();
    if ($user) {
        echo "Name: {$user['name']}, Email: {$user['email']}\n";
    }
    $stmt->close();

    // Закрытие соединения
    $mysqli->close();
    echo "\n✓ mysqli: Соединение закрыто\n";

} catch (Exception $e) {
    echo "✗ Ошибка mysqli: " . $e->getMessage() . "\n";
    $mysqli->close();
    exit(1);
}

echo "\n✓ Все операции выполнены успешно!\n";
?>