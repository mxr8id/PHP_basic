<!-- ## Вариант 8
Проверка на пустоту с trim: для каждого текстового поля сначала $value = trim($_POST['field'] ?? ''). Затем empty($value). Продемонстрируйте на поле «комментарий»: пустая строка и строка из пробелов — обе дают ошибку. -->

<?php
$error = '';
$comment = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawComment = $_POST['comment'] ?? '';
    $comment = trim($rawComment);
    if (empty($comment)) {
        $error = 'Комментарий не может быть пустым или состоять только из пробелов.';
    } else {
        $error = '';
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Валидация комментария</title></head>
<body>
<form method="post">
    <label>Комментарий:</label>
    <input type="text" name="comment" value="<?= htmlspecialchars($comment) ?>">
    <button type="submit">Отправить</button>
    <?php if ($error): ?>
        <p style="color:red"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</form>
</body>
</html>