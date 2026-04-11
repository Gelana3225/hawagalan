# Haawwaa Galaan

Public-facing website and content administration for **Haawwaa Galaan**—a Laravel application for showcasing community information, agriculture, tourism, leadership, news, and contact details, with a protected admin area for editors.

## Features

- **Public site** — Home with hero slideshow, farming, tourism, and biography pages driven by configurable content.
- **Admin panel** (`/admin`) — Authenticated dashboard to manage page sections, hero slides, gallery-style photo sets, leaders, services, farming items, tourism attractions, news posts, contact information, and a media library.
- **Authentication** — User accounts, login, registration, and email verification via [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze).

## Tech stack

| Layer | Technology |
|--------|------------|
| Backend | PHP 8.2+, [Laravel 11](https://laravel.com/docs/11.x) |
| Frontend | [Vite](https://vitejs.dev/), [Tailwind CSS](https://tailwindcss.com/), [Alpine.js](https://alpinejs.dev/) |
| Database | SQLite by default (MySQL/PostgreSQL supported via `.env`) |
| Testing | PHPUnit (Laravel’s `php artisan test`) |

## Requirements

- PHP 8.2 or newer with common extensions (`openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) 18+ and npm (for asset building)

## Local setup

1. **Clone the repository** and enter the project directory.

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Environment file**

   ```bash
   copy .env.example .env
   ```

   On Unix-like systems, use `cp .env.example .env`.

   Adjust `APP_NAME`, `APP_URL`, and database settings as needed. The default configuration uses SQLite (`DB_CONNECTION=sqlite`); ensure `database/database.sqlite` exists (Laravel’s installer can create it, or create an empty file manually).

4. **Application key**

   ```bash
   php artisan key:generate
   ```

5. **Database**

   ```bash
   php artisan migrate
   ```

6. **Public storage link** (required for uploaded images and media served from `storage/app/public`)

   ```bash
   php artisan storage:link
   ```

7. **Front-end assets**

   ```bash
   npm install
   npm run build
   ```

   For local development with hot reload, use `npm run dev` in a separate terminal.

8. **Run the application**

   ```bash
   php artisan serve
   ```

   Visit `http://127.0.0.1:8000`. Register a user (if registration is enabled) and sign in to access `/admin`.

## Development

- **Full-stack dev** — Run `php artisan serve` and `npm run dev` concurrently so Blade views and Vite assets stay in sync.
- **Tests**

  ```bash
  php artisan test
  ```

- **Code style** — The project includes Laravel Pint (`./vendor/bin/pint`) for PHP formatting.

## Project structure (high level)

- `app/Http/Controllers` — Public `PageController` and `Admin\*` controllers for CMS-style resources.
- `resources/views` — Blade layouts, public pages, and admin screens.
- `database/migrations` — Schema for sections, leaders, services, farming, tourism, news, and related tables.
- `routes/web.php` — Public routes and `/admin` route group.

## Security

Report security issues privately to the repository maintainers. Do not commit real credentials; keep `.env` out of version control.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
