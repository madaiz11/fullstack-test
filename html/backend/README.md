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

## Overview

A Laravel-based REST API for managing property listings with search, sort, and pagination capabilities.

## Features

-   Property listing retrieval with pagination (25 items per page)
-   Search functionality for properties by title and location
-   Sorting capabilities by price and date listed
-   Comprehensive error handling
-   Unit and Feature tests

## Requirements

-   PHP 8.1 or higher
-   Composer
-   MySQL/PostgreSQL
-   Laravel 10.x

## Installation

1. Clone the repository
2. Install dependencies:

```bash
composer install
```

3. Copy `.env.example` to `.env` and configure your database:

```bash
cp .env.example .env
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Run migrations:

```bash
php artisan migrate
```

6. (Optional) Seed the database:

```bash
php artisan db:seed
```

## API Endpoints

### GET /api/properties

Retrieve a paginated list of properties with optional search and sort parameters.

#### Query Parameters

-   `search`: (optional) Search term for property title or location
-   `sort_by`: (optional) Field to sort by (`price` or `date_listed`)
-   `sort_direction`: (optional) Sort direction (`asc` or `desc`)

#### Response Format

```json
{
    "data": [
        {
            "id": 1,
            "title": "Property Title",
            "price": 100000,
            "date_listed": "2024-03-20",
            "location": {
                "full_name": "Location Name",
                "province": "Province",
                "district": "District",
                "sub_district": "Sub District",
                "zipcode": "12345"
            }
        }
    ],
    "meta": {
        "current_page": 1,
        "last_page": 4,
        "per_page": 25,
        "total": 100
    }
}
```

## Testing

Run the test suite:

```bash
php artisan test
```

### Test Coverage

-   **Feature Tests**: Test API endpoints and response structure
-   **Unit Tests**: Test service layer and business logic
-   **Test Cases**:
    -   Pagination functionality
    -   Search functionality
    -   Sorting functionality
    -   Error handling
    -   Input validation

## Acceptance Criteria

### 1. Property Listing Endpoint

-   ✅ Implement `/api/properties` endpoint
-   ✅ Return paginated results (25 items per page)
-   ✅ Include property details and location information

### 2. Search Functionality

-   ✅ Filter properties by title
-   ✅ Filter properties by location
-   ✅ Support combined search criteria
-   ✅ Handle empty search results gracefully

### 3. Sorting Functionality

-   ✅ Sort by price (ascending/descending)
-   ✅ Sort by date listed (ascending/descending)
-   ✅ Default sort by date_listed descending
-   ✅ Validate sort parameters

### 4. Error Handling

-   ✅ Validate input parameters
-   ✅ Handle invalid search queries
-   ✅ Handle missing data scenarios
-   ✅ Handle database errors
-   ✅ Return appropriate HTTP status codes

### 5. Testing Requirements

-   ✅ Comprehensive unit tests
-   ✅ Feature tests for API endpoints
-   ✅ Test all search combinations
-   ✅ Test sorting functionality
-   ✅ Test error scenarios

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
