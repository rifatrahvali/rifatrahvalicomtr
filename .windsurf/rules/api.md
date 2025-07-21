---
trigger: always_on
---

# API Best Practices

## API Design & Structure

- Use Laravel API Resources for consistent data transformation and response formatting.
- Implement rate limiting to prevent API abuse and ensure fair usage.
- Follow semantic API versioning strategies (v1, v2) with proper deprecation notices.
- Return appropriate HTTP status codes (200, 201, 400, 401, 404, 422, 500).
- Use JSON:API or similar standards for consistent API structure.

## API Security & Validation

- Implement proper API authentication using Sanctum or Passport.
- Use consistent error response formats across all API endpoints.
- Validate API requests using Form Request classes.
- Implement API throttling and request filtering middleware.

## API Documentation

- Generate comprehensive API documentation using OpenAPI/Swagger specifications.
- Add a comment line to the code you wrote.
