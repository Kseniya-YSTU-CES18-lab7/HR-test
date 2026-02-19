<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Учёт сотрудников</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">👥 Учёт сотрудников</a>
    
    <button class="navbar-toggler" type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false" 
            aria-label="Переключить навигацию">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Сотрудники</a>
        </li>
      </ul>
      
      <!-- Поиск по ФИО -->
      <form class="d-flex" role="search" id="searchForm">
        <input class="form-control me-2" type="search" 
               id="searchInput" placeholder="Поиск по ФИО...">
        <button class="btn btn-outline-light" type="submit">Найти</button>
      </form>
    </div>
  </div>
</nav>

<div class="container-fluid">