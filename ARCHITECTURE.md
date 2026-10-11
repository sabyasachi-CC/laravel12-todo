# Architecture

## Layers

HTTP routes -> middleware -> Form Request -> controller -> policy -> service -> repository -> Eloquent -> MySQL -> Resource/Blade.

### Controller
Only translates HTTP input into application calls and chooses the response.

### Form Request
Owns request validation and request-level authorization where useful.

### Policy
Owns resource authorization (for example, whether a user owns a TODO).

### Service
Owns application/business workflows and transaction boundaries. It coordinates repositories and prevents business rules from leaking into HTTP code.

### Repository
Owns persistence/query concerns. It provides a stable data-access contract and keeps complex filtering out of controllers.

## Why Service + Repository?
This project uses both because the exercise explicitly targets layered architecture and because the repository boundary makes persistence concerns easy to test or replace. In a small CRUD application, a repository layer can be unnecessary ceremony; Laravel Eloquent itself is often sufficient. Do not add repositories automatically in every Laravel project.

## Policies vs middleware
Middleware answers broad request-level questions such as "is the user an administrator?" Policies answer resource-level questions such as "can this user edit this specific TODO?" Both are used here.

## API versioning
API controllers live under `Api/V1`, and routes use `/api/v1`. A future `/api/v2` can evolve independently without breaking existing consumers.

## Sanctum
Sanctum provides personal access tokens for the API. Tokens are stored hashed by Sanctum; the plaintext token is returned only when it is created.

## Soft deletes
Users and TODOs use Eloquent SoftDeletes. Normal queries exclude deleted rows, while administrative workflows can explicitly use `withTrashed`, `onlyTrashed`, `restore`, or `forceDelete` when those workflows are exposed.

## Security
- Ownership is derived from the authenticated user rather than a submitted `user_id`.
- Policies prevent IDOR against TODO IDs.
- Passwords are hashed through the User model's `hashed` cast.
- Web POST/PUT/DELETE requests use CSRF protection.
- API routes use Sanctum authentication.
- Sensitive model fields are hidden from serialization.
- Validation is centralized in Form Requests.

## Important Laravel decision
The requested `users` fields do not include a password, but session authentication necessarily requires one. Therefore `password` and `remember_token` are included as standard Laravel authentication infrastructure fields, while the requested business fields remain unchanged.
