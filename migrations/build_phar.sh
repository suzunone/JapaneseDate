#!/usr/bin/env bash

git fetch origin master --tags

if [ -f composer.lock ]; then
  rm composer.lock
fi

if [ -d src/ ]; then
  rm -rf src/
fi

cp -rf ../src ./src

composer install --no-dev --optimize-autoloader

mkdir -p ../build

if [ ! -f box.phar ]; then
    wget https://github.com/box-project/box2/releases/download/2.7.5/box-2.7.5.phar -O box.phar
fi

php -d  phar.readonly=0 box.phar build -vv

