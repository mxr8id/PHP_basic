<!-- ## Вариант 8
Форма выбора: переменная $selectedId (например, 2). Массив опций [1 => 'Опция 1', 2 => 'Опция 2', 3 => 'Опция 3']. В <select> выведите <option> для каждого, атрибут selected для элемента с ключом $selectedId. -->

<?php
$selectedId = 2;
$options = [
    1 => 'Опция 1',
    2 => 'Опция 2',
    3 => 'Опция 3'
];
?>
<!DOCTYPE html>
<html>
<head><title>Выпадающий список</title></head>
<body>
<form method="post">
    <select name="option">
        <?php foreach ($options as $id => $label): ?>
            <option value="<?= $id ?>" <?= $id === $selectedId ? 'selected' : '' ?>>
                <?= htmlspecialchars($label) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Отправить</button>
</form>
</body>
</html>