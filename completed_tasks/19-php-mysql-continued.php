<!-- ## Вариант 8
Итерация по результату в цикле while: while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ... }. Соберите массив $items[] = $row. Выведите count($items). Продемонстрируйте на запросе или симуляции. -->

<?php
try {
    $pdo = new PDO('sqlite::memory:');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("CREATE TABLE products (id INTEGER, name TEXT)");
    $pdo->exec("INSERT INTO products VALUES (1, 'Ноутбук'), (2, 'Мышь'), (3, 'Клавиатура')");
    
    $stmt = $pdo->query("SELECT * FROM products");
    $items = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $items[] = $row;
    }
    
    echo "Количество записей: " . count($items) . "\n";
    echo "Содержимое \$items:\n";
    print_r($items);
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>