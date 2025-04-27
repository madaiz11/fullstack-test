# Property Storage Test Project

## Table of Contents

1. [Overview](#overview)
2. [Versions](#versions)
3. [Prerequisites](#prerequisites)
4. [Getting Started](#getting-started)
   - [Installation](#installation)
   - [Configuration](#configuration)
5. [Development](#development)
   - [Running the Services](#running-the-services)
   - [Testing](#testing)
   - [Development Tools](#development-tools)
6. [Database](#database)
   - [Documentation](#database-documentation)
   - [Connection Setup](#database-connection-setup)
7. [Contributing](#contributing)
8. [Troubleshooting](#troubleshooting)

## Overview

A property storage and management system built with:

- Frontend: Next.js
- Backend: Laravel (with Sail)
- Database: MySQL

## Versions

- Laravel: v10.x
- Next.js: v14.x
- PHP: v8.2+
- MySQL: v8.0
- Node.js: v18+ (required)
- npm: v9+ (required)
- Docker: Latest stable version

## Prerequisites

### System Requirements

- Docker Desktop
- Node.js (v18 or higher)
- npm (v9 or higher) or yarn
- Git
- Composer (for initial Laravel Sail installation)

### Development Environment

- IDE with PHP and JavaScript support recommended
- MySQL client (e.g., DBeaver) for database management

## Getting Started

### Installation

1. Clone the repository:

```bash
git clone <repository-url>
cd property-storage-test-1
```

2. Backend Setup:

```bash
cd backend

# Install composer dependencies
composer install

# Configure environment
cp .env.example .env

# Start Laravel Sail and setup database
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
```

3. Frontend Setup:

```bash
cd frontend
npm install   # or yarn install
```

### Configuration

1. Backend Environment (.env):

   - Configure database settings
   - Set application URL
   - Configure any additional services

2. Frontend Environment:
   - Configure API endpoints
   - Set environment variables if needed

## Development

### Running the Services

#### Backend Service (Laravel)

```bash
cd backend

# Start the service
./vendor/bin/sail up -d

# Stop the service
./vendor/bin/sail down
```

The backend will be available at `http://localhost:80`

#### Frontend Service (Next.js)

```bash
cd frontend
npm run dev   # or yarn dev
```

The frontend will be available at `http://localhost:3000`

### Testing

#### Backend Tests

```bash
cd backend
./vendor/bin/sail test
```

#### Frontend Tests

```bash
cd frontend
npm test   # or yarn test
```

### Development Tools

#### Backend Development

- Laravel Sail (Docker development environment)
- Laravel Artisan CLI
- PHP CS Fixer for code styling
- PHPUnit for testing
- Laravel Debugbar for debugging
- Laravel IDE Helper for better IDE support

#### Frontend Development

- Next.js Development Server
- ESLint for code linting
- Prettier for code formatting
- Jest for unit testing
- React Developer Tools

#### Database Tools

- Laravel Migrations
- Laravel Seeders
- MySQL client (e.g., DBeaver)

#### Version Control

- Git
- GitHub/GitLab workflow

## Database

### Database Documentation

Comprehensive database documentation is available at:

- [Database Documentation](backend/database/README.md)

Key topics covered:

- Entity Relationship Diagram
- Schema and Table Descriptions
- Indexes and Constraints
- Data Types and Validation Rules
- Best Practices
- Migration and Seeding

### Database Connection Setup

#### DBeaver Configuration

1. Connection Settings:

   - Host: `DB_HOST` from backend/.env (default: localhost)
   - Port: `DB_PORT` from backend/.env (default: 3306)
   - Database: `DB_DATABASE` from backend/.env
   - Username: `DB_USERNAME` from backend/.env
   - Password: `DB_PASSWORD` from backend/.env

2. Fix "Public Key Retrieval" Error:

   - Go to Driver Properties
   - Set `allowPublicKeyRetrieval` = TRUE
   - Set `useSSL` = FALSE

   Or add to your connection URL:

   ```
   jdbc:mysql://${DB_HOST}:${DB_PORT}/${DB_DATABASE}?allowPublicKeyRetrieval=true&useSSL=false
   ```

Note: Replace the `${...}` variables with the actual values from your backend/.env file. Do not commit sensitive database credentials to version control.

## Contributing

1. Ensure all tests pass before submitting PRs
2. Follow the existing code style and conventions
3. Create issues for bugs and feature requests
4. Document significant changes

## Troubleshooting

### Common Issues

1. Database Connection Issues

   - Verify Docker containers are running
   - Check connection settings
   - Ensure proper permissions

2. Development Server Issues
   - Clear cache and node modules if needed
   - Verify port availability
   - Check logs for errors
