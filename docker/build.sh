#!/usr/bin/env bash

docker-compose up -d --force-recreate --build --remove-orphans

# COMPOSER UPDATE
 docker run --rm --tty \
  --volume $PWD/../:/app \
  --volume $HOME/.composer:/tmp \
  --user $(id -u):$(id -g) \
  composer update

docker exec -it laravel-phpfpm php bin/artisan config:cache
docker exec -it laravel-phpfpm php bin/artisan config:clear
