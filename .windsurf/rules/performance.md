---
trigger: always_on
---

# Performance Optimization

## Database Performance

- Prevent N+1 query problems using eager loading (`with()`, `load()`) and lazy loading.
- Implement caching strategies using Redis, model caching, and query result caching.
- Optimize database queries with proper indexing and selective field retrieval.
- Implement database connection pooling and query optimization.
- Use Laravel's built-in caching mechanisms (Cache facade, model caching).
- Optimize Eloquent queries with `select()`, `chunk()`, and `cursor()` methods.
- Implement proper pagination for large datasets.

## Application Performance

- Use image optimization techniques and CDN integration for static assets.
- Use queue jobs for time-consuming operations.
- Monitor and profile application performance regularly.
- Add a comment line to the code you wrote.