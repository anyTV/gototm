gotoTM
====
Scrutinizer : [![Build Status](https://scrutinizer-ci.com/g/anyTV/gototm/badges/build.png?b=master)](https://scrutinizer-ci.com/g/anyTV/gototm/build-status/master)
Travis CI : [![Build Status](https://travis-ci.org/anyTV/gototm.svg?branch=master)](https://travis-ci.org/anyTV/gototm)

This application replaces the old redirection service of goto.tm hosted in dreamhost that has only a list of .htaccess redirect condition and rules.
The problem with that is maintainability, efficiency and doesn't keep track useful informations like clicks, ip addresses, user agents, etc. that can be used for tracking and analytics.

For this version, only freedom.tm or any.tv email addresses is allowed to sign in and create short urls

Requirements
----------------
-   - apache/nginx server
-   - mongo DB
-   - PHP >= 5.5.9 with OpenSSL, curl, PDO, Mbstring, and Tokenizer extension
-   - Node.js

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

