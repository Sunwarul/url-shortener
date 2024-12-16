# URL Shortener App

## Installation:

### Requirements:

- PHP 8.2+
- MySQL
- Composer (For PHP Dependency)
- NodeJS LTS (with Npm)

### Dependency install:

- `git clone git@github.com:Sunwarul/url-shortener.git`
- `cp .env.example .env`
- `composer install`
- `npm install && npm run build`
- `php artisan migrate --seed`

### To run the application locally:

- `php artisan serve`
- Open `http://localhost:8000` in your browser to access
