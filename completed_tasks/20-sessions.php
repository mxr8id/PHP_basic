<?php
session_start();

if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 0;
}
$_SESSION['visits']++;

?>
<!DOCTYPE html>
<html>
<head><title>Счётчик посещений</title></head>
<body>
<h1>Вы посетили эту страницу <?= $_SESSION['visits'] ?> раз(а)</h1>
<p>Обновите страницу (F5), чтобы увеличить счётчик.</p>
</body>
</html>