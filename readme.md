gotoTM
====

URL Forwarder


Running the Application
------------------

```sh
cp .env.example .env
```

Change .env according to you local environment settings

Run these once or when adding packages:

```sh
git clone https://github.com/anyTV/gototm.git
composer install
npm install
gulp
```

To view the application:

```sh
gulp
sudo php artisan serve --host=www.goto.tm --port=80
```

