#!/bin/bash
php artisan route:cache
php artisan migrate:fresh
php artisan db:seed
php artisan serve

