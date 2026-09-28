/usr/local/opt/php@7.2/bin/php artisan serve

/usr/local/opt/php@7.2/bin/php artisan optimize:clear

This app is one codebase shared by many organisations. See `doc/00-index.md` for how organisation ids, the superadmin portal, and tenant scoping work. Do not run `php artisan migrate` on production until the isolation tests in `tests/Feature/TenantIsolationTest.php` pass.
