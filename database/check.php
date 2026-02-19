<?php
require_once '../config/database.php';

$pdo = getDB();

echo "<h2>📊 База данных</h2>";
echo "<p>Файл: " . __DIR__ . "/hr_accounting.sqlite</p>";

// Проверка таблицы
$result = $pdo->query("SELECT * FROM employees");
$employees = $result->fetchAll();

echo "<h3>Сотрудников: " . count($employees) . "</h3>";

if (count($employees) > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>ФИО</th><th>Отдел</th><th>Должность</th><th>Зарплата</th><th>Статус</th></tr>";
    foreach ($employees as $emp) {
        $status = $emp['is_fired'] ? 'Уволен' : 'Работает';
        echo "<tr>";
        echo "<td>{$emp['id']}</td>";
        echo "<td>" . htmlspecialchars($emp['full_name']) . "</td>";
        echo "<td>" . htmlspecialchars($emp['department']) . "</td>";
        echo "<td>" . htmlspecialchars($emp['position']) . "</td>";
        echo "<td>" . number_format($emp['salary'], 0, '.', ' ') . " ₽</td>";
        echo "<td>$status</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>📭 Пока нет сотрудников. Добавьте первого через форму!</p>";
}
?>