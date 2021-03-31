<?php

larvel new project-name

//add auth routes and views (ui)
composer require laravel/ui
php artisan ui vue --auth

//check .env for database setup. Rename db if you want
//connect to server in GUI
//create db

//migrate data
php artisan migrate

//add tailwind
https://tailwindcss.com/docs/guides/laravel#configure-tailwind-with-laravel-mix

npm install -D tailwindcss@latest postcss@latest autoprefixer@latest

mix.postCss("resources/css/app.css", "public/css", [
    require("tailwindcss"),
]);

npm install

npm run dev

//if it fails do this:
https://github.com/JeffreyWay/laravel-mix/issues/307