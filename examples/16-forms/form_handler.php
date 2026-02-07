<?php

/**
 * Лекция 16: Получение данных от элементов формы с помощью PHP
 * Пример обработки POST и GET
 */

// Получение данных из формы (POST)
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = (int)($_POST['age'] ?? 0);
    
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Имя обязательно";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Неверный формат email";
    }
    
    echo "Обработка POST:\n";
    echo "Username: $username, Email: $email, Age: $age\n";
    if (!empty($errors)) {
        echo "Ошибки: " . implode(', ', $errors) . "\n";
    }
}

// Получение данных из GET
$search = $_GET['search'] ?? '';
$page = (int)($_GET['page'] ?? 1);
echo "\nGET: search='$search', page=$page\n";

// Обработка файлов (пример - в реальности нужна форма с enctype="multipart/form-data")
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['avatar'];
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $fileName = uniqid() . '_' . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {
        echo "Файл загружен: $fileName\n";
    }
}
