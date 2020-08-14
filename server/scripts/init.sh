#!/usr/bin/env bash

sudo su

source /var/hostvars

if [ ! -f /var/init ]

    then

    echo -e "${g}Subindo aplicação...${nc}"
    cd /app/docker
    docker-compose up -d --force-recreate --build --remove-orphans

    echo -e "${g}Atualizando composer...${nc}"
    mkdir ${COMPOSER_HOME:-$HOME/.composer} &>/dev/null && mkdir /home/vagrant/.composer &>/dev/null
    chmod -R 777 ${COMPOSER_HOME:-$HOME/.composer} && chmod -R 777 /home/vagrant/.composer
    docker run --rm --interactive \
    --volume $PWD/../:/app \
    --volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp \
    --user $(id -u):$(id -g) \
    composer update

    echo -e "${g}Atualizando npm...${nc}"
    cd /app
    npm install --no-bin-links
    npm run dev

    docker exec laravel-phpfpm php bin/artisan migrate --seed

    echo -e "${g}Limpando cache...${nc}"
    docker exec laravel-phpfpm php bin/artisan config:cache
    docker exec laravel-phpfpm php bin/artisan config:clear

    echo -e "${g}Atualizando permissões...${nc}"
    chown vagrant:vagrant /app/*
    chown vagrant:vagrant /home/vagrant

    touch /var/init
	exit

fi

echo -e "${g}Subindo aplicação...${nc}"
cd /app/docker
docker-compose up -d --force-recreate --build --remove-orphans
