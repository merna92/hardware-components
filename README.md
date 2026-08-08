# Hardware Components

Laravel and MySQL e-commerce recommendation system for computer hardware components, PC builds, product comparison, orders, support tickets, and admin management.

Hardware Components is a fullstack Laravel project for browsing computer parts, comparing products, creating PC builds, requesting recommendations, placing orders, writing reviews, managing wishlists, and opening support tickets. Admins manage catalog data, orders, users, discounts, recommendations, and dashboard metrics.

## Academic Context

This repository was prepared as the organized foundation for a fullstack Laravel team project.

- Instructor: Eng. Mohamed Gamal Zayan
- Team size: 5 members
- Team lead / repository owner: Merna Mohamed Elatafy

## Team

| Member | Role | LinkedIn |
| --- | --- | --- |
| Merna Mohamed Elatafy | Repository owner / Fullstack developer | Add LinkedIn URL |
| Gerges Nabil | Fullstack developer | Add LinkedIn URL |
| Team Member 3 | Fullstack developer | Add LinkedIn URL |
| Team Member 4 | Fullstack developer | Add LinkedIn URL |
| Team Member 5 | Fullstack developer | Add LinkedIn URL |

## Stack

- PHP 8.0+
- Laravel 9
- MySQL
- Blade templates
- Bootstrap
- HTML, CSS, JavaScript
- Manual authentication

## Setup

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Create a MySQL database named `hardware_components` before running migrations.

## Project Docs

- `docs/DATA-MODEL.md`
- `docs/IMPLEMENTATION-PLAN.md`
- `docs/ROADMAP.md`
- `docs/CONTRIBUTING.md`

## Current Foundation

- Laravel project initialized.
- MySQL environment defaults prepared.
- Core database migrations added.
- Reference seed data added for categories and brands.
- Team workflow docs added for parallel feature branches.

## Branch Workflow

The team should work from feature branches and merge through pull requests.

```bash
git checkout main
git pull
git checkout -b feature/feature-name
```

Recommended branches are documented in `docs/IMPLEMENTATION-PLAN.md`.
