<?php
// Создание таблицы employees
require_once '../config/database.php';

$pdo = getDB();

$pdo->exec("
CREATE TABLE IF NOT EXISTS employees (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    full_name TEXT NOT NULL,
    birth_date TEXT NOT NULL,
    passport_series TEXT NOT NULL,
    passport_number TEXT NOT NULL,
    contact_info TEXT NOT NULL,
    address TEXT NOT NULL,
    department TEXT NOT NULL,
    position TEXT NOT NULL,
    salary REAL NOT NULL,
    hire_date TEXT NOT NULL,
    is_fired INTEGER DEFAULT 0,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
)
");

echo "✅ База данных создана успешно!<br>";
echo "📁 Файл: " . __DIR__ . '/hr_accounting.sqlite';
?>