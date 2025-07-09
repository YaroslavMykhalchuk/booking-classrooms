# Booking Classrooms System

Система бронювання аудиторій для закладу освіти, реалізована на Laravel 12. Дозволяє викладачам бронювати аудиторії, а адміністраторам — керувати ними та задавати обслуговування.

## Функціонал

- 📅 Бронювання аудиторій на конкретні дні та пари
- 👤 Аутентифікація та підтвердження користувачів
- 🔐 Ролі (користувачі та адміністратори)
- 🏫 Адмін-панель:
  - Керування аудиторіями
  - Керування користувачами
  - Створення бронювань для обслуговування
- 📨 Відновлення паролю через email
- 🧹 Автоматичне очищення бронювань щоп'ятниці

## Технології

- Laravel 12
- Blade, Bootstrap 5
- MySQL
- Laravel Vite (JS/CSS)
- SMTP (Gmail)

## Встановлення

1. Клонувати репозиторій:
   ```bash
   git clone https://github.com/your_username/booking-classrooms.git
   cd booking-classrooms
2. Встановити залежності:
   ```bash
   composer install
   npm install && npm run dev
3. Налаштувати .env
   ```bash
   cp .env.example .env
   php artisan key:generate
4. Налаштувати базу даних та запустити міграції:
   ```bash
   php artisan migrate
5. Створити дефолтного адміністратора:
   ```bash
   php artisan db:seed

## Креденшали адміністратора

**Email:** `admin@example.com`  
**Пароль:** `password`

## Додатково
Щоб працювало відновлення паролю, правильно налаштуйте SMTP у `.env`

Щоб запустити регулярне очищення бронювань, налаштуйте `cron`:
```bash
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```
## Автор
Ярослав Михальчук

GitHub: [YaroslavMykhalchuk](https://github.com/YaroslavMykhalchuk)

