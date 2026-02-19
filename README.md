# HR-test
Тестовое задание: Учет сотрудников.

## Функционал (по заданию)
- Просмотр всех сотрудников в таблице
- Фильтрация по отделу и должности  
- Поиск по ФИО
- Создание нового сотрудника
- Редактирование информации
- Увольнение (но сотрудник не удаляется, а помечается статусом «Уволен» с блокировкой редактирования)

## Технологии
- Frontend: HTML, CSS, Bootstrap 5.2, Vanilla JavaScript
- Backend: PHP + PDO
- Database: SQLite (не требует установки сервера)

## Запуск

### Вариант 1: XAMPP (Windows)
1. Установить XAMPP: https://www.apachefriends.org/
2. Скопировать папку проекта в: `C:\xampp\htdocs\HR-test`
3. Запустить XAMPP Control Panel → нажать **Start** у Apache
4. Открыть в браузере: `http://localhost/HR-test/database/init.php` (который создаст базу)
5. Открыть: `http://localhost/HR-test/` — всё!

### Вариант 2: Встроенный сервер PHP
```bash
# В папке проекта выполнить:
php -S localhost:8000

# Затем открыть:
http://localhost:8000/database/init.php  # создаст базу
http://localhost:8000/                   # главная страница
