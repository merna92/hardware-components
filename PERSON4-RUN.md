# Person 4 - Admin Dashboard, Users And Coupons

This part adds:

- Admin Dashboard Analytics.
- Users Management.
- Coupons Management.
- Exclusive-style header and footer.

## Run Steps

Use PHP 8.2 or newer.

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Open:

- `/admin/dashboard`
- `/admin/users`
- `/admin/coupons`
