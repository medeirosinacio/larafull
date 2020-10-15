#!/usr/bin/env bash

if [ ! -f /var/firstboot ]

    then

    sudo su

    source /var/hostvars

    echo -e "${g}Instalando serviços essenciais...${nc}"
	apk add zip unzip curl wget vim tree net-tools

    echo -e "${g}Instalando Git...${nc}"
    apk add git

	echo -e "${g}Instalando Docker...${nc}"
	apk add docker
	rc-update add docker boot
	service docker start
	adduser vagrant docker
	addgroup -S vagrant docker

	echo -e "${g}Instalando docker-compose...${nc}"
	apk add docker-compose

	echo -e "${g}Instalando NPM...${nc}"
#	apk add --update nodejs npm
#	npm install --global cross-env

	echo -e "${g}Setando alias...${nc}"
    echo "alias artisan=\"docker exec laravel-phpfpm php artisan\"" >> /home/vagrant/.bash_profile
    echo "alias composer=\"docker run --rm --interactive --volume /app:/app --volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp --user $(id -u):$(id -g) composer\"" >> /home/vagrant/.bash_profile
    echo "alias cleancache=\"docker exec laravel-phpfpm php artisan config:cache && docker exec laravel-phpfpm php artisan config:clear\"" >> /home/vagrant/.bash_profile
    echo "alias dockerup=\"docker-compose up -d --force-recreate --build --remove-orphans\"" >> /home/vagrant/.bash_profile

    touch /var/firstboot
	exit

fi
