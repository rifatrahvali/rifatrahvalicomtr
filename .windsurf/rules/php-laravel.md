---
trigger: always_on
---

# PHP/Laravel Guidelines

## PHP/Laravel Core Rules

- Use PHP 8.1+ features when appropriate (e.g., typed properties, match expressions).
- Follow PSR-12 coding standards.
- Use strict typing: declare(strict_types=1);
- Utilize Laravel 12's built-in features and helpers when possible.
- Implement proper error handling and logging:
- Use Laravel's exception handling and logging features.
- Create custom exceptions when necessary.
- Use try-catch blocks for expected exceptions.
- Use Laravel's validation features for form and request validation.
- Implement middleware for request filtering and modification.
- Utilize Laravel's Eloquent ORM for database interactions.
- Use Laravel's query builder for complex database queries.
- Implement proper database migrations and seeders.
- Add a comment line to the code you wrote.

## Laravel Best Practices

- Use Eloquent ORM instead of raw SQL queries when possible.
- Implement Repository pattern for data access layer.
- Use Laravel's built-in authentication and authorization features.
- Utilize Laravel's caching mechanisms for improved performance.
- Implement job queues for long-running tasks.
- Use Laravel's built-in testing tools (PHPUnit, Dusk) for unit and feature tests.
- Implement API versioning for public APIs.
- Use Laravel's localization features for multi-language support.
- Implement proper CSRF protection and security measures.
- Use Laravel Mix or Vite for asset compilation.
- Implement proper database indexing for improved query performance.
- Use Laravel's built-in pagination features.
- Implement proper error logging and monitoring.
- Implement proper database transactions for data integrity.
- Use Blade components to break down complex UIs into smaller, reusable units.
- Use Laravel's event and listener system for decoupled code.
- Implement Laravel's built-in scheduling features for recurring tasks.
- Add a comment line to the code you wrote.