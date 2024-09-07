# ecommerce-book
A simple site for selling books with an easy-to-use dashboard.

# Installation 
You can install this project in your server through follow this commands
```bash
git clone https://github.com/yhyasyrian/ecommerce-book
cd ecommerce-book
composer install
npm i
npm run build
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

# Config project
```bash
cp .env.example .env
```
Then edit the `.env` file (set the site title and description, and payment keys).
```bash
php artisan migrate
php artisan db:seed
```
To create the table with the admin user in production, if you use the site locally, it will create test data.

## speed site
You can create cache files to improve performance.
```bash
php artisan view:cache
php artisan route:cache
php artisan config:cache 
```
# Some notes for developers
If you need to edit search authors, categories, or publishers, you can do that in.
* As blade in file: `resources/views/livewire/view-utilities.blade.php`
* As data and information in: `app/Livewire/Vite*.php`
* As information in these utilities in: `app/Livewire/ViewUtilities.php`

If you need to create pages as resources in the dashboard, you can do that with these tips:
* Add route in `routes/dashboard.php`
* Create class in `app/Dashboard/PAGEResource.php` and extands `App\Services\DashboardResource\ResourceService`


# Features
* Responsive location on various screens
* Use livewire for dynamic some commands (search authors and categories, and add book to cart, and set stars)
* Dashboard for add books and categories and authors and users, change role users
* Payments method (Strip - Paypal)
* Search engine optimization is done through a tool artesaos/seotools

# Contributing
Contributions are welcome!
