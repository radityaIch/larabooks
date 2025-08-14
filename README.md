# Laravel Books

This is a Laravel 12 project scaffolded with default Laravel skeleton, including factories, seeders, and queue workers.

## Requirements

- PHP ^8.2
- Composer
- Node.js & npm
- MySQL for database

---

## Installation

1. Clone the repository:

```bash
git clone https://github.com/radityaIch/larabooks
cd larabooks
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install Node.js dependencies:

```bash
npm install
```

4. Copy the environment file and generate app key:

```bash
cp .env.example .env
php artisan key:generate
```

5. Adjust the database connection in `.env` file:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<your-database>
DB_USERNAME=<your-database-username>
DB_PASSWORD=<your-database-password>
```

6. Run the migration with the seed:

```bash
composer run seed:fresh
```

7. Wait until process seeding finished with output similar like this, then stop the process:

```bash
[log] [2025-08-13 13:25:34] local.INFO: ✅ [Ratings] Seeding complete
[log] [2025-08-13 13:25:34] local.INFO: ℹ️ [Ratings] Batch finished. Batch finished. Press CTRL + C to stop the seeder.
```

8. Run the program

```bash
composer run dev
```
