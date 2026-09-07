# Task Management System

A Laravel task management application with authentication, task CRUD operations, ownership authorization, search, filtering, validation, and database seed data.

## Features

- User registration, login, logout, and email verification middleware
- Create, edit, and delete personal tasks
- Task ownership enforced through `TaskPolicy`
- Search by task title or description
- Filter by status and priority
- Server-side validation with dedicated Form Request classes
- SQLite/MySQL-compatible migrations, factories, and seeders
- Responsive task management interface

## Requirements

- PHP 8.3 or newer
- Composer
- Node.js and npm
- SQLite or MySQL

## Installation

Clone the repository and enter the project directory:

```bash
git clone <YOUR_GITHUB_REPOSITORY_URL>
cd task-manager
```

Install PHP and JavaScript dependencies:

```bash
composer install
npm install
```

Create the environment file and application key:

```bash
copy .env.example .env
php artisan key:generate
```

Configure the database in `.env`. For SQLite, create the database file if it does not exist:

```bash
type nul > database/database.sqlite
```

Then set:

```env
DB_CONNECTION=sqlite
```

Run migrations and seed demo data:

```bash
php artisan migrate --seed
```

Build frontend assets:

```bash
npm run build
```

Start the development server:

```bash
php artisan serve
```

Open `http://127.0.0.1:8000` in a browser.

## Demo Account

The database seeder creates the following account:

```text
Email: admin@example.com
Password: password
```

Change or remove demo credentials before using the application in production.

## Testing

Run the feature and unit test suite with:

```bash
php artisan test --compact
```

Run formatting and static analysis checks with:

```bash
vendor/bin/pint --dirty --format agent
php artisan route:list
```

## Project Structure

- `app/Models`: Eloquent models and relationships
- `app/Policies`: Task ownership authorization
- `app/Http/Controllers`: Task request coordination
- `app/Http/Requests`: Create and update validation rules
- `database/migrations`: Database schema
- `database/factories` and `database/seeders`: Test and demo data
- `resources/views/tasks`: Task listing and form views
- `tests/Feature`: Authentication and task workflow coverage
