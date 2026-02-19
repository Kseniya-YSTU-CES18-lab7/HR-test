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

// POST: создать нового
if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $pdo->prepare("INSERT INTO employees 
        (full_name, birth_date, passport_series, passport_number, 
         contact_info, address, department, position, salary, hire_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $data['full_name'], $data['birth_date'], $data['passport_series'],
        $data['passport_number'], $data['contact_info'], $data['address'],
        $data['department'], $data['position'], $data['salary'], $data['hire_date']
    ]);
    
    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
    exit;
}

// PUT: редактировать (только если не уволен)
if ($method === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Проверка: нельзя редактировать уволенного
    $check = $pdo->prepare("SELECT is_fired FROM employees WHERE id = ?");
    $check->execute([$data['id']]);
    if ($check->fetchColumn()) {
        http_response_code(403);
        echo json_encode(['error' => 'Нельзя редактировать уволенного']);
        exit;
    }
    
    $stmt = $pdo->prepare("UPDATE employees SET 
        full_name=?, birth_date=?, passport_series=?, passport_number=?,
        contact_info=?, address=?, department=?, position=?, 
        salary=?, hire_date=? WHERE id=?");
    
    $stmt->execute([
        $data['full_name'], $data['birth_date'], $data['passport_series'],
        $data['passport_number'], $data['contact_info'], $data['address'],
        $data['department'], $data['position'], $data['salary'], 
        $data['hire_date'], $data['id']
    ]);
    
    echo json_encode(['success' => true]);
    exit;
}