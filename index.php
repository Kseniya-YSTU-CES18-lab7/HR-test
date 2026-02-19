<?php 
require_once 'config/database.php';
require_once 'includes/header.php'; 
?>

<!-- Фильтры: отдел и должность -->
<div class="card mb-4">
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-5">
        <label class="form-label">Отдел</label>
        <select class="form-select" id="filterDepartment">
          <option value="">Все отделы</option>
          <option>IT</option>
          <option>HR</option>
          <option>Продажи</option>
          <option>Бухгалтерия</option>
        </select>
      </div>
      <div class="col-md-5">
        <label class="form-label">Должность</label>
        <select class="form-select" id="filterPosition">
          <option value="">Все должности</option>
          <option>Разработчик</option>
          <option>Менеджер</option>
          <option>Бухгалтер</option>
          <option>HR-специалист</option>
        </select>
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100" id="applyFilters">Применить</button>
      </div>
    </div>
  </div>
</div>

<!-- Кнопка добавления -->
<div class="mb-3">
  <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#employeeModal">
    ➕ Добавить сотрудника
  </button>
</div>

<!-- Таблица сотрудников -->
<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ФИО</th>
        <th>Дата рождения</th>
        <th>Паспорт</th>
        <th>Контакты</th>
        <th>Адрес</th>
        <th>Отдел</th>
        <th>Должность</th>
        <th>Зарплата</th>
        <th>Принят</th>
        <th>Статус</th>
        <th>Действия</th>
      </tr>
    </thead>
    <tbody id="employeesTable">
      <!-- Заполняется через JS -->
    </tbody>
  </table>
</div>

<!-- Окно: Добавление/Редактирование -->
<div class="modal fade" id="employeeModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="employeeForm">
        <input type="hidden" id="employeeId">
        
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Новый сотрудник</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        
        <div class="modal-body">
          <div class="row g-3">
            <!-- ФИО -->
            <div class="col-md-6">
              <label class="form-label">ФИО *</label>
              <input type="text" class="form-control" id="fullName" required>
            </div>
            
            <!-- Дата рождения -->
            <div class="col-md-6">
              <label class="form-label">Дата рождения *</label>
              <input type="date" class="form-control" id="birthDate" required>
            </div>
            
            <!-- Паспорт: серия и номер (с маской) -->
            <div class="col-md-3">
              <label class="form-label">Серия *</label>
              <input type="text" class="form-control" id="passportSeries" 
                     maxlength="4" pattern="\d{4}" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Номер *</label>
              <input type="text" class="form-control" id="passportNumber" 
                     maxlength="6" pattern="\d{6}" required>
            </div>
            
            <!-- Контактная информация (с маской) -->
            <div class="col-md-6">
              <label class="form-label">Контакты *</label>
              <input type="tel" class="form-control" id="contactInfo" 
                     placeholder="+7 (___) ___-__-__" required>
            </div>
            
            <!-- Адрес -->
            <div class="col-12">
              <label class="form-label">Адрес *</label>
              <textarea class="form-control" id="address" rows="2" required></textarea>
            </div>
            
            <!-- Отдел и должность -->
            <div class="col-md-6">
              <label class="form-label">Отдел *</label>
              <select class="form-select" id="department" required>
                <option value="">Выберите</option>
                <option>IT</option>
                <option>HR</option>
                <option>Продажи</option>
                <option>Бухгалтерия</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Должность *</label>
              <select class="form-select" id="position" required>
                <option value="">Выберите</option>
                <option>Разработчик</option>
                <option>Менеджер</option>
                <option>Бухгалтер</option>
                <option>HR-специалист</option>
              </select>
            </div>
            
            <!-- Зарплата и дата приёма -->
            <div class="col-md-6">
              <label class="form-label">Зарплата *</label>
              <input type="number" class="form-control" id="salary" 
                     step="0.01" min="0" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Дата приёма *</label>
              <input type="date" class="form-control" id="hireDate" required>
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
          <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once 'includes/footer.php'; ?>