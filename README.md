# SkitchBB
A simple, open source bulletin board built with modern technologies.

## Installation
```bash
# copy config file.
cp .env.example .env

# install dependencies
composer install
npm install && npm run dev

# setup framework
php artisan key:generate
php artisan migrate
php artisan db:seed

# start server
php artisan serve
```

The above should start a local dev server at [http://localhost:8000](http://localhost:8000). An admin user is automatically created with `db:seed`. You can login with user: `admin@skitchbb.net`, password: `admin`.
