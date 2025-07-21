---
trigger: always_on
---

# Testing Guidelines

## Comprehensive Testing Strategy

- Write comprehensive feature tests covering both positive and negative scenarios for each endpoint.
- Isolate business logic in unit tests using mocking and dependency injection.
- Utilize Database Factories and Seeders for consistent test data generation.
- Mock external services and APIs to ensure test reliability and speed.
- Implement test-driven development (TDD) approach where applicable.
- Maintain minimum 80% code coverage for critical business logic.

## Laravel Testing Tools

- Use Laravel's built-in testing helpers (`assertStatus`, `assertJson`, etc.).
- Test database transactions and rollbacks properly.
- Create separate test databases for different environments.
- Add a comment line to the code you wrote.