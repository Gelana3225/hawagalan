# Haawwaa Galaan

Production-ready Laravel platform for managing and publishing community content for **Haawwaa Galaan**.  
The project combines a public-facing website with a secure admin panel for content operations.

## Table of Contents

- [Overview](#overview)
- [Core Capabilities](#core-capabilities)
- [Architecture](#architecture)
- [Technology Stack](#technology-stack)
- [Prerequisites](#prerequisites)
- [Quick Start](#quick-start)
- [Running in Development](#running-in-development)
- [Testing and Code Quality](#testing-and-code-quality)
- [Project Structure](#project-structure)
- [Deployment Notes](#deployment-notes)
- [Security](#security)
- [Contributing](#contributing)
- [License](#license)

## Overview

Haawwaa Galaan is a content-driven web application that supports:

- Publishing pages related to community life, agriculture, tourism, leadership, and updates.
- Managing content through an authenticated admin dashboard.
- Serving uploaded media assets through Laravel's public storage pipeline.

The application is designed for maintainability, editor usability, and fast iterative updates.

## Core Capabilities

- **Public Website**
  - Homepage with configurable hero slideshow.
  - Dedicated pages for farming, tourism, biography, services, and general sections.
  - News and contact information accessible to visitors.

- **Admin Dashboard** (`/admin`)
  - CRUD workflows for sections, slides, gallery/media items, leaders, services, farming entries, tourism attractions, and news.
  - Centralized media library management.
  - Role-protected access through Laravel authentication.

- **Authentication**
  - Account registration/login flows.
  - Email verification support.
  - Starter auth scaffolding via [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze).

## Architecture

The codebase follows standard Laravel conventions:

- Routing and request handling through `routes/web.php` and controller layers.
- Blade-based server-rendered UI for both public and admin experiences.
- Relational schema managed through migrations.
- Asset pipeline managed by Vite for modern front-end builds.

## Technology Stack

| Layer | Technology |
| --- | --- |
| Backend | PHP 8.2+, [Laravel 11](https://laravel.com/docs/11.x) |
| Frontend | [Vite](https://vitejs.dev/), [Tailwind CSS](https://tailwindcss.com/), [Alpine.js](https://alpinejs.dev/) |
| Database | SQLite by default (MySQL/PostgreSQL configurable via `.env`) |
| Auth | [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze) |
| Testing | PHPUnit (`php artisan test`) |

## Prerequisites

Install the following before setup:

- PHP 8.2+ with extensions: `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) 18+ and npm
- A local database engine (SQLite, MySQL, or PostgreSQL)

## Quick Start

```bash
# 1) Install dependencies
composer install
npm install

# 2) Configure environment
cp .env.example .env
# On Windows PowerShell, use: copy .env.example .env

# 3) Generate app key
php artisan key:generate

# 4) Prepare database (SQLite default)
# Ensure database/database.sqlite exists, then:
php artisan migrate

# 5) Link storage for uploaded media
php artisan storage:link

# 6) Build frontend assets
npm run build

# 7) Start application
php artisan serve
```

Open `http://127.0.0.1:8000` and sign in at `/admin`.

## Running in Development

For full-stack local development, run backend and Vite dev server concurrently:

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

This enables hot-reloaded assets while serving Laravel routes locally.

## Testing and Code Quality

```bash
# Run automated tests
php artisan test

# Format PHP code
./vendor/bin/pint
```

Recommended before opening a pull request:

1. Run tests locally.
2. Apply formatting.
3. Verify core admin flows and media upload behavior.

## Project Structure

- `app/Http/Controllers` - Public and `Admin\*` controllers
- `resources/views` - Blade layouts, public pages, and admin views
- `database/migrations` - Database schema definitions
- `routes/web.php` - Public and admin web routes
- `public` - Public web root and built assets

## Deployment Notes

- Set `APP_ENV=production` and `APP_DEBUG=false`.
- Configure a production-ready `APP_URL`.
- Run `php artisan migrate --force` during deployment.
- Ensure `php artisan storage:link` has been executed on the target host.
- Build assets with `npm run build` and serve from `public/build`.

## Security

- Never commit secrets or real credentials.
- Keep `.env` private and environment-specific.
- Report vulnerabilities privately to project maintainers.

## Contributing

Contributions are welcome. For effective collaboration:

1. Create a feature branch from the default branch.
2. Keep changes scoped and reviewable.
3. Include tests or validation steps for behavior changes.
4. Submit a pull request with a clear description and test notes.

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
