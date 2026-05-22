<!-- ## Вариант 8
Обработка select: форма с <select name="city">. Варианты: moscow, spb, other. Получите $_POST['city'] ?? ''. Выведите «Выбран город: {city}» или «Город не выбран». -->

<?php
$selectedCity = $_POST['city'] ?? '';
?>
<!DOCTYPE html>
<html>
<head><title>Выбор города</title></head>
<body>
<form method="post">
    <select name="city">
        <option value="moscow">Москва</option>
        <option value="spb">Санкт-Петербург</option>
        <option value="other">Другой</option>
    </select>
    <button type="submit">Выбрать</button>
</form>
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <?php if ($selectedCity !== ''): ?>
        <p>Выбран город: <?= htmlspecialchars($selectedCity) ?></p>
    <?php else: ?>
        <p>Город не выбран</p>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>