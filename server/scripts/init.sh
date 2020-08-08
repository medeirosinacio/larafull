#!/usr/bin/env bash

sudo su

source /var/hostvars

echo -e "${g}Subindo aplicação...${nc}"
cd /app/docker
docker-compose up -d --force-recreate --build --remove-orphans

echo -e "${g}Atualizando composer...${nc}"
mkdir ${COMPOSER_HOME:-$HOME/.composer} &>/dev/null
chmod -R 777 ${COMPOSER_HOME:-$HOME/.composer}
docker run --rm --interactive \
--volume $PWD/../:/app \
--volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp \
--user $(id -u):$(id -g) \
composer update

chown vagrant:vagrant /app/*
chown vagrant:vagrant /home/vagrant

docker exec laravel-phpfpm php bin/artisan config:cache
docker exec laravel-phpfpm php bin/artisan config:clear

alias artisan="docker exec laravel-phpfpm php bin/artisan"
alias composer="docker run --rm --interactive \
--volume /app:/app \
--volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp \
--user $(id -u):$(id -g) \
composer"
alias cleancache="docker exec laravel-phpfpm php bin/artisan config:cache && docker exec laravel-phpfpm php bin/artisan config:clear"
alias npm="docker run -v /app:/usr/src/app -w /usr/src/app node:alpine npm"
