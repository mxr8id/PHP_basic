# Лекция 19: Взаимодействие PHP и MySQL (продолжение)

## 1. Теоретическая часть

### Получение данных из запросов

- `fetch()` - одна строка
- `fetchAll()` - все строки
- Режимы: `PDO::FETCH_ASSOC`, `FETCH_OBJ`, `FETCH_NUM`

### Работа с результатами

- Итерация через `while ($row = $stmt->fetch())`
- Подсчёт строк: `$stmt->rowCount()` (для SELECT не всегда надёжен в PDO)

### Преобразование данных

- Приведение типов при извлечении
- Группировка через SQL GROUP BY или в PHP

### Пагинация

- `LIMIT :limit OFFSET :offset`
- Вычисление offset: `($page - 1) * $perPage`
- bindValue с PDO::PARAM_INT для LIMIT/OFFSET

---

## 2. Синтаксис и основные концепции

```php
$stmt->fetch(PDO::FETCH_ASSOC);
$stmt->fetchAll();
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
```

---

## 3. Рабочие примеры с пояснениями

См. файлы в `examples/19-mysql-continued/`

---

## 4. Практические задания

1. **Задание 1**: Получите все строки из таблицы через fetchAll(PDO::FETCH_ASSOC). Выведите в цикле.

2. **Задание 2**: Реализуйте пагинацию: параметры page и perPage из GET, запрос с LIMIT и OFFSET.

3. **Задание 3**: Используйте fetch_object() в mysqli для получения строк как объектов.

4. **Задание 4**: Напишите функцию `getUserById(PDO $pdo, int $id): ?array`, возвращающую пользователя или null.

---

## 5. Частые ошибки и их решение

| Ошибка | Причина | Решение |
|--------|---------|---------|
| LIMIT строка | PDO bind по умолчанию - строка | bindValue(..., PDO::PARAM_INT) |
| fetch после fetchAll | Указатель уже в конце | Используйте один метод за запрос |
| rowCount для SELECT | В PDO зависит от драйвера | Используйте COUNT(*) в запросе |
| Пагинация с отрицательной страницей | $page из GET | (int)max(1, $_GET['page'] ?? 1) |
