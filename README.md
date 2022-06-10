# Invoices_v2.0

---------------------------- Upload Laravel ----------------------------------
php artisan migrate:fresh

php artisan db:seed
php artisan db:seed --class=PermissionTableSeeder
php artisan db:seed --class=CreateAdminUserSeeder

php artisan make:mail registration

php artisan key:generate
