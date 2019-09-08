#!/bin/sh

composer install
php -S localhost:3000 -t ./htdocs
