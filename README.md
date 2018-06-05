# SkitchBB
A simple, open source bulletin board built with modern technologies.

![Board Index](https://i.imgur.com/mpHs6YL.png)

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

While optional, it is also recommended that you activate the worker process for queued jobs. This drastically speeds up some processes, especially those that send out email.

To enable job queuing, change `QUEUE_DRIVER=sync` to `QUEUE_DRIVER=database` in your .env file. Then run `php artisan queue:work` from a terminal. Since this process will only last as long as you're connected to the terminal, you'll also need to use something like [Superviser](https://laravel.com/docs/5.6/queues#supervisor-configuration) for keeping the process online in a production environment.

The above should start a local dev server at [http://localhost:8000](http://localhost:8000). An admin user is automatically created with `db:seed`. You can login with user: `admin@skitchbb.net`, password: `admin`.
