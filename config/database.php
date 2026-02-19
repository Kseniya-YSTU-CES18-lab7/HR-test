<?php
// Подключимся к базе данных через PDO
function getDB() {
    $host = 'localhost';
    $dbname = 'hr_accounting';
    $username = 'root';
    $password = '';
    
    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $username,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        return $pdo;
    } catch(PDOException $e) {
        die("Ошибка подключения: " . $e->getMessage());
    }
}
?>