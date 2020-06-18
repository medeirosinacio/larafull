#!/usr/bin/env bash

cd ../../../../

vagrant up && vagrant ssh

cd shared/html/laravel7-my-startpack/docker

./build.sh

docker exec -it laravel-phpfpm php bin/artisan config:cache
docker exec -it laravel-phpfpm php bin/artisan config:clear
