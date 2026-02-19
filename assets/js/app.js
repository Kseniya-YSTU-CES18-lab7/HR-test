// Маска для телефона: +7 (___) ___-__-__
document.getElementById('contactInfo')?.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.startsWith('8')) value = '7' + value.slice(1);
    if (value.length > 0) value = '+7' + value;
    if (value.length > 2) value = value.slice(0, 2) + ' (' + value.slice(2);
    if (value.length > 6) value = value.slice(0, 6) + ') ' + value.slice(6);
    if (value.length > 10) value = value.slice(0, 10) + '-' + value.slice(10);
    if (value.length > 13) value = value.slice(0, 13) + '-' + value.slice(13);
    e.target.value = value.slice(0, 18);
});

// Маска для серии паспорта (4 цифры)
document.getElementById('passportSeries')?.addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 4);
});

// Маска для номера паспорта (6 цифр)
document.getElementById('passportNumber')?.addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 6);
});

// Загрузка сотрудников при старте
document.addEventListener('DOMContentLoaded', loadEmployees);

// Загрузка данных из API
async function loadEmployees() {
    const params = new URLSearchParams({
        department: document.getElementById('filterDepartment')?.value || '',
        position: document.getElementById('filterPosition')?.value || '',
        search: document.getElementById('searchInput')?.value || ''
    });
    
    const response = await fetch(`api/employees.php?${params}`);
    const employees = await response.json();
    
    const tbody = document.getElementById('employeesTable');
    tbody.innerHTML = employees.map(emp => `
        <tr class="${emp.is_fired ? 'table-secondary' : ''}">
            <td>${escapeHtml(emp.full_name)}</td>
            <td>${emp.birth_date}</td>
            <td>${emp.passport_series} ${emp.passport_number}</td>
            <td>${escapeHtml(emp.contact_info)}</td>
            <td>${escapeHtml(emp.address)}</td>
            <td>${escapeHtml(emp.department)}</td>
            <td>${escapeHtml(emp.position)}</td>
            <td>${parseFloat(emp.salary).toLocaleString('ru-RU')} ₽</td>
            <td>${emp.hire_date}</td>
            <td>${emp.is_fired ? '<span class="badge bg-danger">Уволен</span>' : '<span class="badge bg-success">Работает</span>'}</td>
            <td>
                ${!emp.is_fired ? `
                    <button class="btn btn-sm btn-outline-primary" onclick="editEmployee(${emp.id})">✏️</button>
                    <button class="btn btn-sm btn-outline-danger" onclick="fireEmployee(${emp.id})">Уволить</button>
                ` : '🔒'}
            </td>
        </tr>
    `).join('');
}

// Применение фильтров
document.getElementById('applyFilters')?.addEventListener('click', loadEmployees);

// Поиск по ФИО
document.getElementById('searchForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    loadEmployees();
});

// Сохранение сотрудника (создание или редактирование)
document.getElementById('employeeForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const data = {
        id: document.getElementById('employeeId').value || null,
        full_name: document.getElementById('fullName').value,
        birth_date: document.getElementById('birthDate').value,
        passport_series: document.getElementById('passportSeries').value,
        passport_number: document.getElementById('passportNumber').value,
        contact_info: document.getElementById('contactInfo').value,
        address: document.getElementById('address').value,
        department: document.getElementById('department').value,
        position: document.getElementById('position').value,
        salary: document.getElementById('salary').value,
        hire_date: document.getElementById('hireDate').value
    };
    
    const method = data.id ? 'PUT' : 'POST';
    
    await fetch('api/employees.php', {
        method: method,
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    });
    
    // Закрыть модальное окно и перезагрузить таблицу
    bootstrap.Modal.getInstance(document.getElementById('employeeModal')).hide();
    loadEmployees();
});

// Редактирование сотрудника
async function editEmployee(id) {
    const response = await fetch(`api/employees.php?id=${id}`);
    const emp = await response.json();
    
    document.getElementById('employeeId').value = emp.id;
    document.getElementById('fullName').value = emp.full_name;
    document.getElementById('birthDate').value = emp.birth_date;
    document.getElementById('passportSeries').value = emp.passport_series;
    document.getElementById('passportNumber').value = emp.passport_number;
    document.getElementById('contactInfo').value = emp.contact_info;
    document.getElementById('address').value = emp.address;
    document.getElementById('department').value = emp.department;
    document.getElementById('position').value = emp.position;
    document.getElementById('salary').value = emp.salary;
    document.getElementById('hireDate').value = emp.hire_date;
    
    document.getElementById('modalTitle').textContent = 'Редактирование';
    new bootstrap.Modal(document.getElementById('employeeModal')).show();
}

// Увольнение сотрудника (в задании: не удалять, а помечать)
async function fireEmployee(id) {
    if (!confirm('Уволить сотрудника? Редактирование будет заблокировано.')) return;
    
    await fetch('api/employees.php', {
        method: 'DELETE',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id: id})
    });
    
    loadEmployees();
}

// Защита от XSS
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}