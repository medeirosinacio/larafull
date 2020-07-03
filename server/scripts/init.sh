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

artisan config:cache
artisan config:clear