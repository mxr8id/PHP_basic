<?php

/**
 * Лекция 17: Проверка данных формы с помощью PHP
 *
 * Запуск: через веб-сервер (php -S localhost:8000)
 * или через CLI для тестирования логики
 */

$errors = [];
$data = [];
$success = false;

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    // Валидация имени
    $name = trim($_POST['name'] ?? '');
    if (empty($name)) {
        $errors['name'] = "Имя обязательно";
    } elseif (strlen($name) < 2) {
        $errors['name'] = "Имя должно быть не менее 2 символов";
    } elseif (strlen($name) > 100) {
        $errors['name'] = "Имя не должно превышать 100 символов";
    } else {
        // Экранирование для вывода в HTML
        $data['name'] = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    }

    // Валидация email
    $email = trim($_POST['email'] ?? '');
    if (empty($email)) {
        $errors['email'] = "Email обязателен";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Неверный формат email";
    } elseif (strlen($email) > 254) {
        $errors['email'] = "Email слишком длинный";
    } else {
        // FILTER_SANITIZE_EMAIL deprecated в PHP 8.1+
        // Просто сохраняем валидный email
        $data['email'] = $email;
    }

    // Валидация возраста
    $ageRaw = $_POST['age'] ?? '';
    $age = filter_var($ageRaw, FILTER_VALIDATE_INT);

    if ($age === false || $age === null) {
        $errors['age'] = "Возраст должен быть числом";
    } elseif ($age < 18 || $age > 100) {
        $errors['age'] = "Возраст должен быть от 18 до 100";
    } else {
        $data['age'] = $age;
    }

    // Дополнительная валидация: согласие с условиями
    $terms = $_POST['terms'] ?? '';
    if (empty($terms) || $terms !== 'on') {
        $errors['terms'] = "Необходимо согласиться с условиями";
    }

    // Если нет ошибок - обработка данных
    if (empty($errors)) {
        $success = true;
        // Здесь можно сохранить данные в БД
        // Например: $db->insert('users', $data);
    }
}

// Вывод для тестирования через CLI
if (php_sapi_name() === 'cli' && !empty($_SERVER['argv'])) {
    parse_str(implode('&', array_slice($argv, 1)), $cliArgs);
    $_POST = $cliArgs;
    // Повторный запуск валидации
    // ... (код валидации)
}

// Для веб-окружения выводим форму
if (php_sapi_name() !== 'cli'):
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Форма регистрации</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
            .error { color: #d32f2f; margin: 5px 0; font-size: 14px; }
            .success { color: #2e7d32; padding: 15px; background: #e8f5e9; border-radius: 4px; margin: 20px 0; }
            .form-group { margin-bottom: 15px; }
            label { display: block; margin-bottom: 5px; font-weight: bold; }
            input[type="text"], input[type="email"], input[type="number"] {
                width: 100%; padding: 8px; box-sizing: border-box;
                border: 1px solid #ddd; border-radius: 4px;
            }
            input[type="checkbox"] { margin-right: 10px; }
            button { background: #1976d2; color: white; padding: 10px 20px;
                border: none; border-radius: 4px; cursor: pointer;
                font-size: 16px; }
            button:hover { background: #1565c0; }
        </style>
    </head>
    <body>
    <h1>Регистрация пользователя</h1>

    <?php if ($success): ?>
        <div class="success">
            <h2>✓ Регистрация успешна!</h2>
            <p>Данные сохранены:</p>
            <ul>
                <li><strong>Имя:</strong> <?= htmlspecialchars($data['name']) ?></li>
                <li><strong>Email:</strong> <?= htmlspecialchars($data['email']) ?></li>
                <li><strong>Возраст:</strong> <?= $data['age'] ?></li>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name"
                   value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            <?php if (!empty($errors['name'])): ?>
                <div class="error"><?= $errors['name'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <?php if (!empty($errors['email'])): ?>
                <div class="error"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="age">Возраст:</label>
            <input type="number" id="age" name="age"
                   value="<?= htmlspecialchars($_POST['age'] ?? '') ?>">
            <?php if (!empty($errors['age'])): ?>
                <div class="error"><?= $errors['age'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="terms"
                    <?= isset($_POST['terms']) ? 'checked' : '' ?>>
                Я согласен с условиями
            </label>
            <?php if (!empty($errors['terms'])): ?>
                <div class="error"><?= $errors['terms'] ?></div>
            <?php endif; ?>
        </div>

        <button type="submit">Зарегистрироваться</button>
    </form>

    <?php if (!empty($errors) && !$success): ?>
        <div style="margin-top: 20px; padding: 15px; background: #ffebee; border-radius: 4px;">
            <strong>Исправьте ошибки в форме</strong>
        </div>
    <?php endif; ?>
    </body>
    </html>
<?php endif; ?>