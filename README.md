# Task Management System

A robust task management application built with Laravel, MySQL, and Tailwind CSS.

## Features
- **Authentication**: Secure user login, registration, and session management.
- **Task CRUD**: Complete Create, Read, Update, and Delete operations for tasks.
- **Task Authorization**: User-level task isolation enforced using Laravel Policies (`TaskPolicy`).
- **Search & Filtering**: Search tasks by keyword (title/description) and filter by status and priority with query string persistence.
- **Validation**: Dedicated Form Request classes (`StoreTaskRequest`, `UpdateTaskRequest`) with validation feedback.
- **Database Seeding**: Ready-to-test sample data generated via factories and seeders.

---

## Installation & Setup

### 1. Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL or SQLite

### 2. Clone the Repository
```bash
git clone <YOUR_GITHUB_REPOSITORY_URL>
cd task-manager
