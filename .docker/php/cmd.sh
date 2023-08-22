#!/bin/bash
sleep 50
ping -c 1 host.docker.internal
if [ $? -eq 0 ]; then
  echo "xdebug.client_host=host.docker.internal" > $PHP_INI_DIR/conf.d/custom-002.ini
else
  echo "xdebug.client_host=$(ip route|awk '/default/ { print $3 }')" > $PHP_INI_DIR/conf.d/custom-002.ini
fi
composer install
php init --env=Development --overwrite=No
php yii migrate --interactive=0 --migrationPath=@vendor/filsh/yii2-oauth2-server/src/migrations
php yii migrate --interactive=0 --migrationPath=@yii/rbac/migrations
php yii migrate --interactive=0

set -m
php-fpm &
fg %1