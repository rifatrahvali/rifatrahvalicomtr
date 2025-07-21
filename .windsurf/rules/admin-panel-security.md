---
trigger: always_on
---

# Admin Panel Security Procedures

## Authentication & Authorization Requirements

- All admin routes must be **protected by authentication middleware** (`auth`, `verified`, `role:admin`).
- **Role-based authorization** is required; access to admin features must be restricted via policies or gates.
- Login routes should include **rate limiting** to prevent brute-force attacks.
- Use **2FA (Two-Factor Authentication)** for admin users.

## Input Validation & Security

- CSRF protection must be enabled across all admin forms.
- Always validate input using **FormRequest** classes.
- Prevent XSS by using Blade's escaped output (`{{ }}`) and avoid raw HTML output.
- Avoid raw SQL – use Eloquent ORM or Laravel Query Builder.
- File uploads must be validated for type, size, and extension.

## Auditing & Access Control

- Critical actions (login, role changes, deletes) must be **logged and auditable**.
- Admin users should only access data they're authorized to view (row-level access control).
- Hide sensitive fields from unauthorized users (e.g., passwords, PII).

## Production Security

- Enforce HTTPS; ensure `APP_URL` starts with `https://`.
- Customize the admin panel route (e.g., `/secure-admin`) to prevent common attacks.
- **Disable dev tools** (`Telescope`, `Debugbar`, `Horizon`) in production environments.
