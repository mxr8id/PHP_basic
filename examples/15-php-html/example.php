<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>PHP и HTML</title>
</head>
<body>
    <?php
    $title = "Добро пожаловать";
    $users = ["John", "Jane", "Bob"];
    ?>
    
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?= htmlspecialchars($user, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
    </ul>
    
    <?php if (count($users) > 0): ?>
        <p>Найдено <?= count($users) ?> пользователей</p>
    <?php else: ?>
        <p>Пользователи не найдены</p>
    <?php endif; ?>
    
    <form method="post">
        <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit">Отправить</button>
    </form>
</body>
</html>
