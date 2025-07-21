---
trigger: always_on
---

# Code Quality & Standards

## Code Quality Tools

- Integrate PHPStan or Psalm for static analysis and type checking.
- Use Laravel Pint for consistent code formatting and style enforcement.
- Implement pre-commit hooks to enforce code quality standards before commits.
- Maintain minimum 80% code coverage with comprehensive testing.
- Use Laravel IDE Helper for better IDE support and autocompletion.
- Implement automated code review tools and linting in CI/CD pipeline.

## Design Principles

- Use dependency injection container and service providers properly.
- Follow SOLID principles and design patterns consistently.
- Implement proper exception handling with custom exception classes.
- Use Laravel's built-in validation and form request classes.

## Code Commenting Requirements

- All code generated must include relevant inline comments (All comments must be written in Turkish.) explaining its purpose, logic, and behavior.
- All comments must be written in Turkish.
- Comments must follow the language's standard (e.g., // for PHP, /** */ for PHPDoc, <!-- --> for HTML).
- Avoid generic comments. Be clear, concise, and contextual (e.g., // Validate the input before saving to DB, not just // validation).
- For functions, always describe input parameters, return values, and side effects if any.
- Add a comment line to the code you wrote.