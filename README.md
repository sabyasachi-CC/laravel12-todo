# Laravel 12 TODO Application

A production-style TODO application demonstrating layered Laravel architecture, session authentication, Sanctum API tokens, authorization policies, middleware, services, repositories, Eloquent, Form Requests, API Resources, Bootstrap, soft deletes, pagination, filtering, and tests.

## Requirements

- PHP 8.2+
- Composer 2+
- MySQL 8+
- Node.js 20+

## Install

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Create a MySQL database named `laravel_todo` (or change `.env`), then:

```bash
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

## Development

```bash
php artisan migrate:fresh --seed
php artisan test
npm run dev
```

## Seeded users

- Admin: `admin@example.com` / `password`
- User: `user@example.com` / `password`

Change these credentials for any non-local environment.

## Web routes

- `/login`
- `/register`
- `/todos`
- `/profile`
- `/admin/users`
- `/admin/todos`

## API v1

- `POST /api/v1/auth/register`
- `POST /api/v1/auth/login`
- `POST /api/v1/auth/logout`
- `GET /api/v1/auth/me`
- `GET|POST /api/v1/todos`
- `GET|PUT|DELETE /api/v1/todos/{todo}`
- `GET|PUT|DELETE /api/v1/users/{user}` (admin)

Send API tokens as `Authorization: Bearer <token>`.

## API filtering

```text
GET /api/v1/todos?status=1&search=laravel&sort=-created_at&per_page=15
```

## Architecture

See `ARCHITECTURE.md` for design decisions and responsibilities.
