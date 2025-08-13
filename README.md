# Laravel Project

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

7. Wait until process finished with output like this, then stop the process:

```bash
[log] [2025-08-13 13:25:34] local.INFO: ✅ [Ratings] Seeding complete. Batch ID: 9f9fe60d-06fe-4f70-88d3-c3b7e29fb9ec  
[log] [2025-08-13 13:25:34] local.INFO: ℹ️ [Ratings] Batch finished. Batch finished. Press CTRL + C to stop the seeder.
```

8. Run the program

```bash
composer run dev
```

---

## About Composer Scripts

### Development

Start Laravel server, 1 listener, 2 workers, and Vite dev server:

```bash
composer run dev
```

**Features:**

- `php artisan serve` → Laravel dev server
- `php artisan queue:listen --tries=1` → Listener for live code changes
- `php artisan queue:work` → 2 workers for background jobs
- `npm run dev` → Vite dev server

---

### Fresh Seed with Queue Workers

Run migrations fresh and seed the database using 4 parallel queue workers:

```bash
composer run seed:fresh
```

**Features:**

- Uses 4 queue workers for fast seeding
- Tail logs in real-time: `storage/logs/laravel.log`
- Verbose output for workers

---

### Production

Run production build with 2 queue workers:

```bash
composer run prod
```

**Features:**

- `npm run build` → Compiles production assets
- `php artisan serve --env=production` → Laravel server in production mode
- 2 queue workers for background jobs

> ⚠️ Note: For real production, replace `php artisan serve` with Nginx or Apache + PHP-FPM for reliability.

---

### Queue Workers Only

Run 4 workers manually (useful for heavy seeding or background jobs):

```bash
composer run queue:work
```

**Options:**  

- Database queue driver
- Sleep 1s between jobs
- 120s job timeout
- 3 retry attempts

---

### Other Scripts

- `composer run migrate:fresh` → Run migrations fresh
- `composer run test` → Run PHPUnit/Pest tests

---

## Notes

- Faker is installed for generating realistic seed data.
- Queue driver is set to **database**, not Redis, for simplicity.
- All factories preload IDs in memory to improve performance for large datasets.
- Seeders can use **chunking and parallel workers** for massive data (e.g., 100k books, 500k ratings).

---

## License

MIT License

```

---

This README covers **installation, dev, production, queue workers, and seeding instructions** reflecting your `composer.json` scripts.  

If you want, I can **also add a section explaining how to run the batch seeders with parallel jobs and show logs in real-time**, which is very useful for your large dataset seeding workflow.  

Do you want me to add that?
```
