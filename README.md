# Laravel Blog (Laravel 12)

A foundational blog application built with Laravel 12, showcasing common features and practices. This project serves as a starting point or learning resource for Laravel development.

---

## Table of Contents

1. [Introduction](#introduction)
2. [Prerequisites](#prerequisites)
3. [Installation](#installation)
4. [Environment Configuration](#environment-configuration)
5. [Running the Application](#running-the-application)
6. [Running Tests](#running-tests)
7. [Key Features](#key-features)
8. [Technology Stack](#technology-stack)
9. [Project Structure](#project-structure)
10. [Contributing](#contributing)
11. [License](#license)

---

## Introduction

This Laravel Blog application is designed to help developers learn and implement common development patterns using Laravel. It includes modern frontend tooling (Vite), database migrations, and an optional Dockerized setup for PostgreSQL.

---

## Prerequisites

Before starting, ensure that you have the following installed on your machine:

- **PHP**: >= 8.2
- **Composer**: [Dependency Manager for PHP](https://getcomposer.org/)
- **Node.js & NPM**: [JavaScript Runtime and Package Manager](https://nodejs.org/)
- **Docker & Docker Compose**: [Containerization Platform](https://www.docker.com/)

---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/feelipino/blog-laravel.git
   cd blog-laravel
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install NPM dependencies:
   ```bash
   npm install
   ```

4. Build frontend assets:
   ```bash
   npm run build
   ```

---

## Environment Configuration

1. Create your `.env` file:
   ```bash
   cp .env.example .env
   ```

2. Generate an application key:
   ```bash
   php artisan key:generate
   ```

3. Configure your `.env` file:
   Update database credentials and other environment-specific variables as needed.

4. Run database migrations:
   ```bash
   php artisan migrate
   ```

5. (Optional) Seed the database:
   ```bash
   php artisan db:seed
   ```

---

## Running the Application

### Using PHP Artisan Serve
Start the development server:
```bash
composer run dev
```

### Using Docker for the Database
Start the PostgreSQL service:
```bash
docker-compose up -d postgres
```

---

## Running Tests

This project uses Pest for testing:
```bash
php artisan test
```

---

## Key Features

- Laravel 12 Framework
- Vite Frontend Tooling
- Database Migrations & Seeding
- Queue System
- Caching and Session Management
- RESTful API & Web Routes
- Basic Authentication

---

## Technology Stack

**Backend**: PHP 8.2+, Laravel 12  
**Frontend**: Vite, Tailwind CSS, Alpine.js  
**Database**: PostgreSQL (default), MySQL and SQLite configurable  
**Testing**: Pest, PHPUnit  
**Environment**: Docker & Docker Compose

---

## Project Structure

- **app/**: Core application code
- **config/**: Configuration files
- **database/**: Migrations, seeders
- **public/**: Entry point and public assets
- **resources/**: Blade templates, assets
- **routes/**: Route definitions
- **tests/**: Unit and Feature tests

---

## Contributing

1. Fork the repository.
2. Create a feature branch:
   ```bash
   git checkout -b feature/your-feature
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add new feature"
   ```
4. Push to the branch:
   ```bash
   git push origin feature/your-feature
   ```
5. Open a pull request.

---

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.
