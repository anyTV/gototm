gotoTM
====
Scrutinizer : [![Build Status](https://scrutinizer-ci.com/g/anyTV/gototm/badges/build.png?b=master)](https://scrutinizer-ci.com/g/anyTV/gototm/build-status/master)
Travis CI : [![Build Status](https://travis-ci.org/anyTV/gototm.svg?branch=master)](https://travis-ci.org/anyTV/gototm)

URL Forwarder

Running the Application
------------------

Create your local configuration by copying the .env.example from root directory then save it as .env

```sh
cp .env.example .env
```

Change .env according to you local environment settings

#Run these once or when adding packages:

```sh
git clone https://github.com/anyTV/gototm.git
composer install
npm install
gulp
```

#To view the application:

```sh
gulp
sudo php artisan serve --host=www.goto.tm --port=80
```

