# Vehikl Oil Change Challenge

This is a Laravel 12 app with a SQLite database for storing data. This take home challenge is for Vehikl interview stage one.

## Requirements

- PHP 8.2+
- Composer
- Node.js + npm

## Setup

From the project root:

```bash
cd [path-to-directory]
composer install
cp .env.example .env
php artisan key:generate
```

## Database

This app uses SQLite.
Make sure the SQLite file exists:

```bash
touch database/database.sqlite
```

Then run the migrations:

```bash
php artisan migrate
```

## Run the app

Start the Laravel development server:

```bash
php artisan serve
```

Then open:

```text
http://127.0.0.1:8000
```

## Run tests

```bash
php artisan test
```

## Notes

- The home page shows the oil change form.
- Submitted checks are saved to the database.
- The result page is unique per submission and remains visible after refresh.
- Manipulate the URL to access previous Oil checks through the route {id}
