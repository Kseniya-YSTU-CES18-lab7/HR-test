<?php
// SQLite
function getDB() {
    $dbFile = __DIR__ . '/../database/hr_accounting.sqlite';
    
    try {
        $pdo = new PDO("sqlite:$dbFile");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch(PDOException $e) {
        die("Ошибка подключения к БД: " . $e->getMessage());
    }
}
?>