<!-- ## Вариант 8
UPDATE с подготовленным запросом: UPDATE users SET name = ? WHERE id = ?. execute([$name, $id]). Выведите rowCount() — сколько строк обновлено. Симулируйте данные. -->

<?php
$pdo = new PDO('sqlite::memory:');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec("CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT)");
$pdo->exec("INSERT INTO users (id, name) VALUES (1, 'Данила'), (2, 'Дмитрий')");

$newName = 'Иван';
$id = 2;
$stmt = $pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
$stmt->execute([$newName, $id]);
$affectedRows = $stmt->rowCount();

echo "Обновлено строк: $affectedRows\n";

$result = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
print_r($result);
?>