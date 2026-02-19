<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$pdo = getDB();
$method = $_SERVER['REQUEST_METHOD'];

// GET: получить список (с фильтрами и поиском)
if ($method === 'GET') {
    $sql = "SELECT * FROM employees WHERE 1=1";
    $params = [];
    
    // Фильтр по отделу
    if (!empty($_GET['department'])) {
        $sql .= " AND department = ?";
        $params[] = $_GET['department'];
    }
    
    // Фильтр по должности
    if (!empty($_GET['position'])) {
        $sql .= " AND position = ?";
        $params[] = $_GET['position'];
    }
    
    // Поиск по ФИО
    if (!empty($_GET['search'])) {
        $sql .= " AND full_name LIKE ?";
        $params[] = '%' . $_GET['search'] . '%';
    }
    
    // Если передан ID - вернуть одного сотрудника
    if (!empty($_GET['id'])) {
        $sql = "SELECT * FROM employees WHERE id = ?";
        $params = [$_GET['id']];
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    
    if (!empty($_GET['id'])) {
        echo json_encode($stmt->fetch() ?: []);
    } else {
        echo json_encode($stmt->fetchAll());
    }
    exit;
}

