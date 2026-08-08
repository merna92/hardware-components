# Contributing

## Local Setup

1. Copy `.env.example` to `.env`.
2. Create a MySQL database named `hardware_components`.
3. Run `composer install`.
4. Run `php artisan key:generate`.
5. Run `php artisan migrate --seed`.
6. Run `php artisan serve`.

## Git Workflow

- Start from `develop`.
- Create a branch named `feature/short-feature-name`.
- Keep commits focused.
- Do not edit another member's feature files unless you agree together.
- Open a pull request into `develop`.

## Commit Messages

Use clear messages:

- `Add product CRUD`
- `Create manual login flow`
- `Fix order total calculation`

## Code Style

- Controllers handle request flow.
- Models hold relationships.
- Validation should happen before database writes.
- Blade files should stay readable and use Bootstrap classes consistently.
- Keep JavaScript in separate files when it grows beyond a small page script.
