-- Таблица сотрудников
CREATE TABLE IF NOT EXISTS employees (
    id INT PRIMARY KEY AUTO_INCREMENT,
    
    -- Данные из задания:
    full_name VARCHAR(255) NOT NULL,	-- ФИО
    birth_date DATE NOT NULL,	-- Дата рождения
    passport_series VARCHAR(4) NOT NULL,	-- Серия паспорта
    passport_number VARCHAR(6) NOT NULL,	-- Номер паспорта
    contact_info VARCHAR(100) NOT NULL,		-- Контактная информация
    address TEXT NOT NULL,	-- Адрес проживания
    department VARCHAR(100) NOT NULL,	-- Отдел
    position VARCHAR(100) NOT NULL,	-- Должность
    salary DECIMAL(10,2) NOT NULL,	-- Размер зарплаты
    hire_date DATE NOT NULL,	-- Дата принятия
    
    -- Статус увольнения (не удалять, а помечать):
    is_fired TINYINT(1) DEFAULT 0,	-- 0=работает, 1=уволен
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);