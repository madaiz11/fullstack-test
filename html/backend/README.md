<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development/)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Property Storage API

A Laravel-based GraphQL API for managing property listings with search, sort, and pagination capabilities.

## Overview

This project uses Laravel Sail, a light-weight command-line interface for interacting with Laravel's default Docker development environment. It provides an excellent starting point for building a Laravel application using PHP, MySQL, and other services.

## Features

-   GraphQL API for property listings
-   Property listing retrieval with pagination (25 items per page)
-   Search functionality for properties by title and location
-   Sorting capabilities by price and date listed
-   Comprehensive error handling
-   Unit and Feature tests

## Dependencies

### Core Dependencies

-   PHP ^8.2
-   Laravel Framework ^12.0
-   Laravel Tinker ^2.10.1
-   Lighthouse (GraphQL) ^6.54
-   Spatie Laravel Data ^4.15

### Development Dependencies

-   Laravel Sail ^1.41
-   PHPUnit ^11.5.3
-   Laravel Pint ^1.13
-   Laravel Pail ^1.2.2
-   Faker ^1.23
-   Mockery ^1.6
-   Collision ^8.6

## Prerequisites

### System Requirements

-   Docker Desktop
    -   Windows/macOS: [Docker Desktop](https://www.docker.com/products/docker-desktop)
    -   Linux: Docker Engine and Docker Compose
-   Minimum 4GB RAM (8GB recommended)
-   Git

### Development Tools

-   Composer (for initial setup)
-   IDE with PHP support (recommended: PHPStorm or VS Code)
-   A GraphQL client (e.g., GraphiQL, Insomnia, or Postman)

## Installation with Sail

1. Clone the repository:

    ```bash
    git clone <repository-url>
    cd html/backend
    ```

2. Install Composer dependencies (using Docker):

    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        composer install --ignore-platform-reqs
    ```

3. Copy environment file:

    ```bash
    cp .env.example .env
    ```

4. Start Laravel Sail:

    ```bash
    ./vendor/bin/sail up -d
    ```

5. Generate application key:

    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

6. Run migrations:

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

7. (Optional) Seed the database:
    ```bash
    ./vendor/bin/sail artisan db:seed
    ```

## Common Sail Commands

```bash
# Start all containers
./vendor/bin/sail up -d

# Stop all containers
./vendor/bin/sail down

# Run tests
./vendor/bin/sail test

# Run artisan commands
./vendor/bin/sail artisan <command>

# Access MySQL CLI
./vendor/bin/sail mysql

# View logs
./vendor/bin/sail logs

# Run composer commands
./vendor/bin/sail composer <command>

# Run Node commands
./vendor/bin/sail npm <command>
```

## GraphQL API

### Endpoint

```
http://localhost/graphql
```

### Available Queries

-   `properties`: Fetch paginated property listings
    -   Parameters:
        -   `filter`: Object containing search and sort parameters
            -   `search`: (optional) Search term for property title or location
            -   `sortKey`: (optional) Field to sort by (`PRICE` or `CREATED_AT`)
            -   `sortOrder`: (optional) Sort direction (`ASC` or `DESC`)
            -   `page`: (optional) Page number
            -   `limit`: (optional) Items per page
            -   `province`: (optional) Filter by province

## Testing

Run the test suite using Sail:

```bash
./vendor/bin/sail test
```

### Test Coverage

-   Feature Tests: Test GraphQL endpoints and response structure
-   Unit Tests: Test service layer and business logic
-   Test Cases:
    -   Pagination functionality
    -   Search functionality
    -   Sorting functionality
    -   Error handling
    -   Input validation

## Development Scripts

```bash
# Run code style fixes
./vendor/bin/sail pint

# Run development server with hot reload
./vendor/bin/sail dev
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
