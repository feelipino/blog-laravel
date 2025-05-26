# Laravel Blog (Laravel 12)

A foundational blog application built with Laravel 12, showcasing common features and practices. This project serves as a starting point or learning resource for Laravel development.

---

## Table of Contents

* [Prerequisites](#prerequisites)
* [Getting Started](#getting-started)
    * [Installation](#installation)
    * [Environment Configuration](#environment-configuration)
* [Running the Application](#running-the-application)
    * [Using PHP Artisan Serve (Development)](#using-php-artisan-serve-development)
    * [Using Docker for the Database](#using-docker-for-the-database)
* [Running Tests](#running-tests)
* [Key Features](#key-features)
* [Technology Stack](#technology-stack)
* [Project Structure](#project-structure)
* [Contributing](#contributing)
* [License](#license)

---

## Prerequisites

Before you begin, ensure you have the following installed:

* **PHP:** >= 8.2
* **Composer:** [Dependency Manager for PHP](https://getcomposer.org/)
* **Node.js & NPM:** (or Yarn) [JavaScript Runtime and Package Manager](https://nodejs.org/)
* **Docker & Docker Compose:** (Required for the provided PostgreSQL service) [Containerization Platform](https://www.docker.com/)

---

## Getting Started

Follow these steps to get your development environment set up.

### Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/feelipino/blog-laravel.git
    cd blog-laravel
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install NPM dependencies:**
    ```bash
    npm install
    ```

4.  **Build frontend assets:**
    ```bash
    npm run build
    ```

### Environment Configuration

1.  **Create your environment file:**
    Copy the example environment file and make the necessary adjustments.
    ```bash
    cp .env.example .env
    ```

2.  **Generate an application key:**
    This key is used for encryption and hashing.
    ```bash
    php artisan key:generate
    ```

3.  **Configure your `.env` file:**
    Open the `.env` file and update the following variables, particularly your database credentials. If you're using the provided Docker setup for PostgreSQL, the default database credentials should work.

    ```dotenv
    APP_NAME="Laravel Blog"
    APP_ENV=local
    APP_DEBUG=true
    APP_URL=http://localhost:8000

    # Database Connection (PostgreSQL example)
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1 # Use 'localhost' or '127.0.0.1' if Laravel is running on host and DB in Docker
    DB_PORT=5432
    DB_DATABASE=blog_laravel
    DB_USERNAME=postgres
    DB_PASSWORD=postgres # Ensure this matches your Docker setup or local DB password

    # Mail Configuration (example using Mailtrap or similar for development)
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_mailtrap_username
    MAIL_PASSWORD=your_mailtrap_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"

    # Queue Connection (defaulting to database)
    QUEUE_CONNECTION=database

    # Cache Driver (defaulting to database)
    CACHE_DRIVER=database

    # Session Driver (defaulting to database)
    SESSION_DRIVER=database
    SESSION_LIFETIME=120
    ```
    *Note: Ensure other settings like `QUEUE_CONNECTION`, `CACHE_DRIVER`, etc., are set as needed for your environment.*

4.  **Run database migrations:**
    This will create the necessary tables in your database. If using the Dockerized PostgreSQL, ensure it's running (see [Using Docker for the Database](#using-docker-for-the-database)).
    ```bash
    php artisan migrate
    ```

5.  **(Optional) Seed the database:**
    If you have database seeders to populate your database with initial data:
    ```bash
    php artisan db:seed
    ```

---

## Running the Application

### Using PHP Artisan Serve (Development)

This is the simplest way to run the application locally for development.

1.  **Start the development server, queue listener, and Vite:**
    The `composer.json` includes a convenient script to run these concurrently:
    ```bash
    composer run dev
    ```
    This command typically executes:
    * `php artisan serve` (PHP development server, usually on `http://localhost:8000`)
    * `php artisan queue:listen --tries=1` (A basic queue worker)
    * `npm run dev` (Vite for frontend asset compilation with hot module replacement)

    Alternatively, you can run these commands in separate terminal windows:
    * **Terminal 1 (PHP Server):** `php artisan serve`
    * **Terminal 2 (Queue Worker):** `php artisan queue:listen --tries=1`
    * **Terminal 3 (Vite):** `npm run dev`

### Using Docker for the Database

This project includes a `docker-compose.yml` file to easily run a PostgreSQL database service.

1.  **Ensure Docker is running:**
    Start Docker Desktop or your Docker daemon.

2.  **Start the PostgreSQL service:**
    Navigate to the project root and run:
    ```bash
    docker-compose up -d postgres
    ```
    This command starts a PostgreSQL container in detached mode. Your `.env` file should be configured to connect to this database (e.g., `DB_HOST=127.0.0.1`, `DB_PORT=5432`, `DB_DATABASE=blog_laravel`, `DB_USERNAME=postgres`, `DB_PASSWORD=postgres` as per `docker-compose.yml`).

3.  **To connect to the database using a client (e.g., pgAdmin, DBeaver):**
    * Host: `127.0.0.1` or `localhost`
    * Port: `5432`
    * User: `postgres`
    * Password: `postgres`
    * Database: `blog_laravel`

4.  **To stop the PostgreSQL service:**
    ```bash
    docker-compose down
    ```
    To stop and remove volumes (deletes data):
    ```bash
    docker-compose down -v
    ```

---

## Running Tests

This project uses Pest for PHP testing.

1.  **Run the test suite:**
    ```bash
    php artisan test
    ```
    Or, use the Composer script (which might include pre-test setup like clearing caches):
    ```bash
    composer test
    ```
    This script typically runs `php artisan config:clear && php artisan test`.

---

## Key Features

* **Laravel 12 Framework:** Leverages the latest features and improvements from the Laravel ecosystem.
* **Vite Frontend Tooling:** Modern, fast frontend build tooling.
* **Database Migrations & Seeding:** Structured database management.
* **Queue System:** Configured for background job processing (defaults to database driver).
* **Caching:** Application-level caching support (defaults to database driver).
* **Session Management:** Robust session handling (defaults to database driver).
* **RESTful API & Web Routes:** Structure for building both web interfaces and APIs.
* **Basic Authentication:**

---

## Technology Stack

**Backend:**
* PHP 8.2+
* Laravel 12

**Frontend:**
* Vite
* Tailwind CSS (commonly used with Laravel Breeze/Jetstream)
* Alpine.js (often paired with Tailwind CSS)
* Bootstrap 5 (available via NPM, can be integrated if preferred)

**Database:**
* PostgreSQL (configured by default with Docker support)
* Easily configurable for MySQL, SQLite, SQL Server via Laravel's `config/database.php` and `.env`.

**Testing:**
* Pest (PHP Testing Framework)
* PHPUnit (underlying testing framework for Pest)

**Development Environment:**
* Docker & Docker Compose (for database containerization)

**Caching & Queues (Defaults):**
* **Cache Driver:** `database`
* **Queue Driver:** `database`
    * *Laravel supports various drivers like Redis, Memcached, SQS, etc., for both.*

---

## Project Structure

A brief overview of the main directories within a standard Laravel application:

* `app/`: Core application code (Controllers, Models, Providers, Services, etc.).
* `bootstrap/`: Framework bootstrapping scripts and compiled files cache.
* `config/`: Application configuration files.
* `database/`: Database migrations, factories, and seeders.
* `public/`: Web server's document root, `index.php` entry point, and public assets.
* `resources/`: Views (Blade templates), raw frontend assets (JS, CSS/Sass), and language files.
* `routes/`: Route definitions (web.php, api.php, console.php, channels.php).
* `storage/`: Compiled Blade templates, file-based sessions, file caches, logs, and other framework-generated files.
* `tests/`: Application tests (Feature, Unit).
* `vendor/`: Composer dependencies.

---

## Contributing

Contributions are welcome and appreciated! To contribute:

1.  **Fork the Project:** Click the 'Fork' button at the top right of this page.
2.  **Create your Feature Branch:**
    ```bash
    git checkout -b feature/your-amazing-feature
    ```
3.  **Commit your Changes:**
    ```bash
    git commit -m 'Add some amazing feature'
    ```
4.  **Push to the Branch:**
    ```bash
    git push origin feature/your-amazing-feature
    ```
5.  **Open a Pull Request:** Navigate to your fork on GitHub and open a new pull request against the original repository's `main` (or `master`) branch.

Please ensure your code adheres to the existing style and that any new functionality is covered by tests.

---

## License

This project is licensed under the MIT License. See the `LICENSE` file in the repository for full license text.
*(If a `LICENSE` file is not present, you should add one. You can easily create a standard MIT License file).*
